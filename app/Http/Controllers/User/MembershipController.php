<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;
use App\Member;
use App\Payment;
use App\Transaction;
use App\AdminMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MembershipController extends Controller 
{
    public function main_page() {
        $user = Auth::user();
        $members = Member::orderBy('price')->get();
        $payments = Member::orderBy('name')->get();

        // Check if user has pending transaction 
        $pendingTransaction = Transaction::where('user_id', $user->id)
            ->where('status', Transaction::STATUS_PENDING)
            ->latest()
            ->first();

        // Check if user has rejected transaction that needs revision
        $rejectedTransaction = Transaction::where('user_id', $user->id)
            ->where('status', Transaction::STATUS_REJECTED)
            ->where('can_edit', true)
            ->latest()
            ->first();

        // Get unread admin messages for the user
        $unreadMessages = AdminMessage::where('user_id', $user->id)
            ->where('is_read', false)
            ->orderBy('created_at', 'desc')->where('status', Transaction::STATUS_REJECTED)
            ->where('can_edit', true)
            ->latest()
            ->get();
        
        // Get unread admin messages for the user
        $allMessages = AdminMessage::where('user_id', $user->id)
            ->where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.user.upgrade.index', compact('user', 'members', 'payments', 'pendingTransaction', 'rejectedTransaction', 'unreadMessages', 'allMessages'));
    }

    // Mark message as read for user 
    public function markMessageAsRead($id)
    {
        $message = AdminMessage::where('user_id', Auth::id())->findOrFail($id);
        $message->is_read = true;
        $message->save();

        return response()->json(['success' => true]);
    }

    // Mark all messages as read for user
    public function markAllMessagesAsRead()
    {
        AdminMessage::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    public function edit_membership() {
        $user = Auth::user();
        $members = Member::orderBy('price')->get();
        $payments = Payment::orderBy('name')->get();

        // Check if user has pending transaction 
        $pendingTransaction = Transaction::where('user_id', $user->id)
            ->where('status', Transaction::STATUS_PENDING)
            ->latest()
            ->first();
        
        // Check if user has rejected transaction that needs revision
        $rejectedTransaction = Transaction::where('user_id', $user->id)
            ->where('status', Transaction::STATUS_REJECTED)
            ->where('can_edit', true)
            ->latest()
            ->first();

        // Get admin message for rejected transaction 
        $rejectMessage = null;
        if($rejectedTransaction) {
            $rejectMessage = AdminMessage::where('transaction_id', $rejectedTransaction->id)
                ->orderBy('created_at', 'desc')
                ->first();
        }

        return view('pages.user.upgrade.edit_membership', compact('user', 'members', 'payments', 'pendingTransaction', 'rejectedTransaction', 'rejectMessage'));
    }

    /**
     * Show edit form for rejected transaction
    */
    public function edit_rejected_transaction($id) 
    {
        $user = Auth::user();
        $transaction = Transaction::with(['member', 'payment'])->findOrFail($id);

        // Check if transaction belongs to user and is rejected and can be edited
        if($transaction->user_id != $user->id || $transaction->status != Transaction::STATUS_REJECTED || !$transaction->can_edit) {
            return redirect()->route('update_membership')
                ->with('error', 'You cannot edit this transaction.');
        }

        $members = Member::orderBy('price')->get();
        $payments = Payment::orderBy('name')->get();

        // Get reject message
        $rejectMessage = AdminMessage::where('transaction_id', $transaction->id)
            ->orderBy('created_at', 'desc')
            ->first();

        return view('pages.user.upgrade.edit_rejected_transaction', compact('transaction', 'members', 'payments', 'rejectMessage'));
    }

    // Update rejected transaction
    public function update_rejected_transaction(Request $request, $id) 
    {
        $user = Auth::user();
        $transaction = Transaction::findOrFail($id);

        // Check if transaction belongs to user and is rejected and can be edited
        if($transaction->user_id != $user->id || $transaction->status != Transaction::STATUS_REJECTED || !$transaction->can_edit) {
            return redirect()->route('update_membership')
                ->with('error', 'You cannot edit this transaction.');
        }

        // Validation rules 
        $rules = [
            'member_id' => 'required|exists:members,id',
            'payment_id' => 'required|exists:payments,id',
            'account_number' => [
                'required',
                'string',
                'min:5',
                'max:50',
                'regex:/^[0-9]+$/', // Only numbers allowed
                Rule::unique('transactions', 'account_number')->ignore($transaction->id) 
            ],
            'payment_proof' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        $messages = [
            'member_id.required' => 'Please select a membership package.',
            'member_id.exists' => 'Selected membership package is invalid.',
            'payment_id.required' => 'Please select a payment method.',
            'payment_id.exists' => 'Selected payment method is invalid.',
            'account_number.required' => 'Account number is required.',
            'account_number.min' => 'Account number must be at least 5 characters.',
            'account_number.max' => 'Account number cannot exceed 50 characters.',
            'account_number.regex' => 'Account number must contain only numbers (0-9).',
            'account_number.unique' => 'This account number is already registered. Please use a different account number.',
            'payment_proof.image' => 'Payment proof must be an image file.',
            'payment_proof.mimes' => 'Payment proof must be JPG, JPEG, or PNG format.',
            'payment_proof.max' => 'Payment proof size must not exceed 2MB.',
        ];

        $this->validate($request, $rules, $messages);

        DB::beginTransaction();

        try {
            // Handle payment proof upload if new file is provided
            if($request->hasFile('payment_proof')) {
                // Delete old payment proof 
                if($transaction->payment_proof && Storage::disk('public')->exists($transaction->payment_proof)) {
                    Storage::disk('public')->delete($transaction->payment_proof);
                }
                $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
                $transaction->payment_proof = $paymentProofPath;
            }

            // Update transaction
            $transaction->member_id = $request->member_id;
            $transaction->payment_id = $request->payment_id;
            $transaction->account_number = $request->account_number;
            $transaction->status = Transaction::STATUS_PENDING; // Change back to pending 
            $transaction->can_edit = false; // Disable further editing 
            $transaction->save();

            DB::commit();

            $selectedMember = Member::find($request->member_id);

            return redirect()->route('update_membership')
                ->with('success', 'Your revised upgrade request to ' . $selectedMember->name . ' has been resubmitted! Please wait for admin approval.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to update transaction: ' . $e->getMessage());
        }
    }

    /**
     * Submit upgrade membership request
    */
    public function submit_upgrade(Request $request)
    {
        $user = Auth::user();

        // Check if user already has pending transaction 
        $existingPending = Transaction::where('user_id', $user->id) 
            ->where('status', Transaction::STATUS_PENDING)
            ->first();

        if($existingPending) {
            return redirect()->route('update_membership')
                ->with('error', 'You already have a pending upgrade request. Please wait for admin approval.');
        }

        // Check if user has rejected transaction that needs to be fixed first 
        $existingRejected = Transaction::where('user_id', $user->id)
            ->where('status', Transaction::STATUS_REJECTED)
            ->where('can_edit', true)
            ->first();

        if($existingRejected) {
            return redirect()->route('edit_rejected_transaction', $existingRejected->id) 
                ->with('error', 'You have a rejected transaction that needs to be fixed. Please edit and resubmit your request.');
        }

        // Check if trying to upgrade to same level 
        $selectedMember = Member::findOrFail($request->member_id);
        if($user->access == $selectedMember->name) {
            return redirect()->route('edit_membership')
                ->with('error', 'You are already a ' . $user->access . ' member.');
        }

        // Validation rules 
        $rules = [
            'member_id' => 'required|exists:members,id',
            'payment_id' => 'required|exists:payments,id',
            'account_number' => [
                'required',
                'string',
                'min:5',
                'max:50',
                'regex:/^[0-9]+$/', // Only numbers allowed
                'unique:transactions,account_number', // Must be unique
            ],
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];

        $messages = [
            'member_id.required' => 'Please select a membership package.',
            'member_id.exists' => 'Selected membership package is invalid.',
            'payment_id.required' => 'Please select a payment method.',
            'payment_id.exists' => 'Selected payment method is invalid.',
            'account_number.required' => 'Account number is required.',
            'account_number.min' => 'Account number must be at least 5 characters.',
            'account_number.max' => 'Account number cannot exceed 50 characters.',
            'account_number.regex' => 'Account number must contain only numbers (0-9).',
            'account_number.unique' => 'This account number is already registered. Please use a different account number.',
            'payment_proof.required' => 'Payment proof image is required.',
            'payment_proof.image' => 'Payment proof must be an image file.',
            'payment_proof.mimes' => 'Payment proof must be JPG, JPEG, or PNG format.',
            'payment_proof.max' => 'Payment proof size must not exceed 2MB.',
        ];

        $this->validate($request, $rules, $messages);

        // Upload payment proof 
        $paymentProofPath = null;
        if($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        // Create transaction 
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'member_id' => $request->member_id,
            'payment_id' => $request->payment_id,
            'payment_proof' => $paymentProofPath,
            'account_number' => $request->account_number,
            'status' => Transaction::STATUS_PENDING,
            'can_edit' => false,
        ]);

        $selectedMember = Member::find($request->member_id);

        return redirect()->route('update_membership')
            ->with('success', 'Your upgrade request to ' . $selectedMember->name . ' has been submitted! Please wait for admin approval.');
    }

}