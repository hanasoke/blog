<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;
use App\Member;
use App\Payment;
use App\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        return view('pages.user.upgrade.index', compact('user', 'members', 'payments', 'pendingTransaction'));
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

        return view('pages.user.upgrade.edit_membership', compact('user', 'members', 'payments', 'pendingTransaction'));
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
            'account_number' => 'required|string|min:5|max:50',
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];

        $messages = [
            'member_id.required' => 'Please select a membership package.',
            'member_id.exists' => 'Selected membership package is invalid.',
            'payment_id.required' => 'Please select a payment method.',
            'payment_id.exists' => 'Selected payment method is invalid.',
            'account_number.required' => 'Account number is required.',
            'account_number.min' => 'Account number must be at least 5 characters.',
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
        ]);

        $selectedMember = Member::find($request->member_id);

        return redirect()->route('update_membership')
            ->with('success', 'Your upgrade request to ' . $selectedMember->name . ' has been submitted! Please wait for admin approval.');
    }

}