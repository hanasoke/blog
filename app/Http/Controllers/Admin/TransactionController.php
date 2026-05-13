<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Transaction;

class TransactionController extends Controller 
{
    public function pending_transaction() {

        $transactions = Transaction::with(['user', 'member', 'payment'])
            ->where('status', Transaction::STATUS_PENDING)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.admin.transaction.pending', compact('transactions'));
    }

    public function cancel_transaction() {
        return view('pages.admin.transaction.cancel');
    }

    public function success_transaction() {
        return view('pages.admin.transaction.success');
    }
}