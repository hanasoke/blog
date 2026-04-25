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
}