<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Transaction;
use App\User;
use App\Member;
use App\Payment;
use App\AdminMessage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller 
{
    public function pending_transaction() 
    {
        $transactions = Transaction::with(['user', 'member', 'payment'])
            ->where('status', Transaction::STATUS_PENDING)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.admin.transaction.pending', compact('transactions'));
    }

    public function approve_transaction(Request $request, $id)
    {
        $request->validate([
            'message' => 'nullable|string|max:500'
        ]);

        DB::beginTransaction();

        try {
            $transaction = Transaction::with(['user', 'member'])->findOrFail($id);

            // Check if transaction is pending 
            if($transaction->status !== Transaction::STATUS_PENDING) {
                return redirect()->back()->with('error', 'Only pending transactions can be approved.');
            }

            // Update transaction status 
            $transaction->status = Transaction::STATUS_APPROVED;
            $transaction->save();

            // Update user's access level 
            $user = $transaction->user;
            $oldAccess = $user->access;
            $user->access = $transaction->member->name;
            $user->save();

            // Create success message template
            $successMessage = $request->message ?: "Congratulations! Your membership upgrade request to {$transaction->member->name} has been approved. Your account has been upgraded from {$oldAccess} to {$transaction->member->name}. Thank you for trusting us!";

            // Save admin message 
            AdminMessage::create([
                'user_id' => $transaction->user_id,
                'transaction_id' => $transaction->id,
                'message' => $successMessage
            ]);

            DB::commit();

            return redirect()->route('pending_transaction')
                ->with('success', "Transaction #{$transaction->id} has been approved. User {$user->name} is now {$transaction->member->name} member.");

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to approve transaction: ' . $e->getMessage());
        }
    }

    public function cancel_transaction() 
    {
        $transactions = Transaction::with(['user', 'member', 'payment'])
            ->whereIn('status', [Transaction::STATUS_REJECTED, Transaction::STATUS_CANCELLED])
            ->orderBy('created_at', 'desc')
            ->get();

        // Get admin messages for each transaction
        foreach($transactions as $transaction) {
            $transaction->admin_message = AdminMessage::where('transaction_id', $transaction->id)
                ->orderBy('created_at', 'desc')
                ->first();
        }

        return view('pages.admin.transaction.cancel', compact('transactions'));
    }

    public function reject_transaction(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|min:5|max:500'
        ], [
            'message.required' => 'Please provide a reason for rejecting this transaction.',
            'message.min' => 'Rejection message must be at least 5 characters.'
        ]);

        DB::beginTransaction();

        try {
            $transaction = Transaction::with(['user', 'member'])->findOrFail($id);

            // Check if transaction is pending 
            if($transaction->status !== Transaction::STATUS_PENDING) {
                return redirect()->back()->with('error', 'Only pending transactions can be rejected.');
            }

            // Update transaction status
            $transaction->status = Transaction::STATUS_REJECTED;
            $transaction->can_edit = true; // Allow user to edit this transaction
            $transaction->save();

            // Save rejection message 
            AdminMessage::create([
                'user_id' => $transaction->user_id,
                'transaction_id' => $transaction->id,
                'message' => $request->message 
            ]);

            DB::commit();

            return redirect()->route('pending_transaction')
                ->with('success', "Transaction #{$transaction->id} has been rejected. User has been notified.");

        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to reject transaction: ' . $e->getMessage());
        }
    }

    public function success_transaction() {
        $transactions = Transaction::with(['user', 'member', 'payment'])
            ->where('status', Transaction::STATUS_APPROVED)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.admin.transaction.success', compact('transactions'));
    }

    public function generate_report(Request $request) 
    {
        // Validate request
        $request->validate([
            'report_type' => 'required|in:all,date_range',
            'start_date' => 'required_if:report_type,date_range|nullable|date',
            'end_date' => 'required_if:report_type,date_range|nullable|date|after_or_equal:start_date',
            'orientation' => 'required|in:portrait,landscape',
        ]);

        // Get approved transactions
        $query = Transaction::with(['user', 'member', 'payment'])
            ->where('status', Transaction::STATUS_APPROVED);

        // Filter by date range if provided
        if ($request->report_type == 'date_range' && $request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00', 
                $request->end_date . ' 23:59:59'
            ]);
        }

        $transactions = $query->orderBy('created_at', 'desc')->get();
        
        // Get total statistics
        $totalTransactions = $transactions->count();
        $totalRevenue = $transactions->sum(function($transaction) {
            return $transaction->member->price ?? 0;
        });

        // Get unique users count
        $uniqueUsers = $transactions->unique('user_id')->count();

        // Group by member package
        $packageStats = [];
        foreach($transactions as $transaction) {
            $packageName = $transaction->member->name ?? 'Unknown';
            if(!isset($packageStats[$packageName])) {
                $packageStats[$packageName] = [
                    'count' => 0,
                    'revenue' => 0
                ];
            }
            $packageStats[$packageName]['count']++;
            $packageStats[$packageName]['revenue'] += $transaction->member->price ?? 0;
        }

        // Get monthly statistics (last 6 months)
        $monthlyStats = [];
        for($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $count = Transaction::where('status', Transaction::STATUS_APPROVED)
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            $revenue = Transaction::where('status', Transaction::STATUS_APPROVED)
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->get()
                ->sum(function($t) {
                    return $t->member->price ?? 0;
                });
            $monthlyStats[$month->format('F Y')] = [
                'count' => $count,
                'revenue' => $revenue
            ];
        }
        
        // Get newest and oldest transaction
        $newestTransaction = $transactions->first();
        $oldestTransaction = $transactions->last();
        
        // Prepare data for PDF
        $data = [
            'transactions' => $transactions,
            'totalTransactions' => $totalTransactions,
            'totalRevenue' => $totalRevenue,
            'uniqueUsers' => $uniqueUsers,
            'packageStats' => $packageStats,
            'monthlyStats' => $monthlyStats,
            'newestTransaction' => $newestTransaction,
            'oldestTransaction' => $oldestTransaction,
            'generated_date' => now()->format('d F Y H:i:s'),
            'generated_by' => auth()->user()->name ?? 'System Administrator',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'report_type' => $request->report_type,
            'orientation' => $request->orientation,
        ];

        // Load view and generate PDF
        $pdf = PDF::loadView('pages.admin.transaction.transaction_report_pdf', $data);

        // Set paper size and orientation
        $paperSize = 'A4';
        $orientation = $request->orientation == 'landscape' ? 'landscape' : 'portrait';
        $pdf->setPaper($paperSize, $orientation);
        
        // Download PDF with custom filename
        $filename = 'success_transaction_report_' . date('Y-m-d_His') . '.pdf';
        
        return $pdf->download($filename);
    }

    public function delete_transaction($id)
    {
        DB::beginTransaction();

        try {
            $transaction = Transaction::with(['user', 'member', 'payment'])->findOrFail($id);
            $transactionUser = $transaction->user->username;
            $transactionId = $transaction->id;

            // Delete payment proof file from storage
            AdminMessage::where('transaction_id', $transaction->id)->delete();

            // Delete the transaction 
            $transaction->delete();

            DB::commit();
            
            return redirect()->route('success_transaction')
                ->with('success', 'Transaction #' . $transactionId . ' from "' . $transactionUser . '" has been successfully deleted!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('success_transaction')
                ->with('success', 'Failed to delete transaction: ' . $e->getMessage());
        }

    }
}