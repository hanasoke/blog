<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TransactionController extends Controller 
{
    public function pending_transaction() {
        return view('pages.admin.transaction.pending');
    }

    public function cancel_transaction() {
        return view('pages.admin.transaction.cancel');
    }

    public function success_transaction() {
        return view('pages.admin.transaction.success');
    }
}