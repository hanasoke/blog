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