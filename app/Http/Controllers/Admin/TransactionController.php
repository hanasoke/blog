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