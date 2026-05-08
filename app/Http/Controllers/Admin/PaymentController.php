<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Payment;
use Illuminate\Validation\Rule;
use PDF; // Import PDF facade

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
            'name.unique' => 'Nama Dompet Pembayaran sudah ada',
            'name.max' => 'Payment name cannot exceed 255 characters.',
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
            ->with('success', 'Dompet "' . $payment->name . '" berhasil dihapus');
    }

    public function generate_report(Request $request)
    {
        // Validate request 
        $request->validate([
            'report_type' => 'required|in:all,date_range',
            'start_date' => 'required_if:report_type,date_range|nullable|date',
            'end_date' => 'required_if:report_type,date_range|nullable|date|after_or_equal:start_date',
            'orientation' => 'required|in:portrait,landscape',
        ]);

        // Get payments with optional date filtering
        $query = Payment::query();

        if ($request->report_type == 'date_range' && $request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00', 
                $request->end_date . ' 23:59:59'
            ]);
        }

        $payments = $query->orderBy('id', 'DESC')->get();

         // Get total statistics
        $totalPayments = $payments->count();
        $newThisMonth = Payment::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Get oldest and newest payment
        $oldestPayment = Payment::orderBy('created_at', 'asc')->first();
        $newestPayment = Payment::orderBy('created_at', 'desc')->first();

          // Prepare data for PDF
        $data = [
            'payments' => $payments,
            'totalPayments' => $totalPayments,
            'newThisMonth' => $newThisMonth,
            'oldestPayment' => $oldestPayment,
            'newestPayment' => $newestPayment,
            'generated_date' => now()->format('d F Y H:i:s'),
            'generated_by' => auth()->user()->name ?? 'System Administrator',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'report_type' => $request->report_type,
            'orientation' => $request->orientation,
        ];

        // Load view and generate PDF
        $pdf = PDF::loadView('pages.admin.payment.payment_report_pdf', $data);

        // Set paper size and orientation
        $paperSize = 'A4';
        $orientation = $request->orientation == 'landscape' ? 'landscape' : 'portrait';
        $pdf->setPaper($paperSize, $orientation);

        // Download PDF with custom filename
        $filename = 'payment_report_' . date('Y-m-d_His') . '.pdf';
        
        return $pdf->download($filename);
    }

    public function export_csv(Request $request)
    {
        $payments = Payment::orderBy('id', 'DESC')->get();
        
        $filename = 'payments_export_' . date('Y-m-d_His') . '.csv';
        
        return response()->stream(function() use ($payments) {
            $output = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel compatibility
            fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Add CSV headers
            fputcsv($output, ['ID', 'Payment Name', 'Created At', 'Last Updated']);
            
            // Add data rows
            foreach($payments as $payment) {
                fputcsv($output, [
                    $payment->id,
                    $payment->name,
                    $payment->created_at ? $payment->created_at->format('Y-m-d H:i:s') : 'N/A',
                    $payment->updated_at ? $payment->updated_at->format('Y-m-d H:i:s') : 'N/A',
                ]);
            }
            
            fclose($output);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

}