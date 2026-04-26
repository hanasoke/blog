<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Payment;
use Illuminate\Validation\Rule;

class PaymentController extends Controller 
{
    public function index() {
        $payments = Payment::orderBy('id', 'DESC')->get();
        return view('pages.admin.payment.index', compact('payments'));
    }

    public function add_payment() {
        return view('pages.admin.payment.add_payment');
    }

    public function save_payment(Request $request) {
        $request->validate([
            'name' => 'required|unique:payments,name'
        ], [
            'name.required' => 'Nama Dompet Pembayaran wajib diisi',
            'nama.unique' => 'Nama Dompet Pembayaran sudah ada'
        ]);

        Genre::create([
            'name' => $request->name
        ]);

        return redirect()
            ->route('payments')
            ->with('success', 'Dompet Pembayaran berhasil ditambahkan');
    }

    public function edit_payment() {
        return view('pages.admin.payment.edit_payment');
    }
}