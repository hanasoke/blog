<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Payment;
use Illuminate\Validation\Rule;

class PaymentController extends Controller 
{
    public function index() {
        return view('pages.admin.payment.index');
    }

    public function add_payment() {
        return view('pages.admin.payment.add_payment');
    }

    public function edit_payment() {
        return view('pages.admin.payment.edit_payment');
    }
}