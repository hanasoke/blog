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

        Payment::create([
            'name' => $request->name
        ]);

        return redirect()
            ->route('payments')
            ->with('success', 'Dompet Pembayaran berhasil ditambahkan');
    }

    public function edit_payment($id) {
        $payment = Payment::findOrFail($id);
        return view('pages.admin.payment.edit_payment', compact('payment'));
    }

    public function update_payment(Request $request ,$id) {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('genres', 'name')->ignore($id)
            ]
            ], [
                'name.required' => 'Nama Dompet Pembayaran wajib diisi',
                'name.unique' => 'Nama Dompet Pembayaran sudah ada' 
            ]);

            $payment = Payment::findOrFail($id);
            $payment->update([
                'name' => $request->name 
            ]);

            return redirect()
                ->route('payments')
                ->with('success', 'Dompet pembayaran berhasil diupdate');
    }

    public function delete_payment($id) {
        $payment = Payment::findOrFail($id);

        $payment->delete();

        return redirect()
            ->route('payments')
            ->with('success', 'Payment "' . $payment->name . '" berhasil dihapus');
    }


}