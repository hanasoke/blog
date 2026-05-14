<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Transaction;
use App\User;
use App\Member;
use App\Payment;
use Illuminate\Support\Facades\Storage;

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

        } catch (\Throwable $th) {
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

        return view('pages.admin.transaction.cancel', compact('transactions'));
    }

    public function success_transaction() {
        $transactions = Transaction::with(['user', 'member', 'payment'])
            ->where('status', Transaction::STATUS_APPROVED)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.admin.transaction.success', compact('transactions'));
    }
}