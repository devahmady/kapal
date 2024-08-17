<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pesan;
use App\Models\Booking;
use App\Models\Payment;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PemesananController extends Controller
{

    public function __construct(PDF $pdf)
    {
        $this->pdf = $pdf;
    }
    public function index(Request $request)
    {
        // Mendapatkan bulan dan tahun dari input atau default ke bulan dan tahun saat ini
        $monthYear = $request->input('month', date('Y-m')); // Menggunakan format YYYY-MM
        list($year, $month) = explode('-', $monthYear); // Memisahkan tahun dan bulan

        // Mengambil data pembayaran berdasarkan bulan dan tahun
        $data['payments'] = Payment::with('pesan.user', 'pesan.route')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        // Mengirim data ke view
        $data['selectedMonth'] = $month;
        $data['selectedYear'] = $year;

        return view('admin.payment.index', $data);
    }


    // Fungsi untuk memperbarui status pembayaran
    public function updateStatus(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->status = $request->input('status');
        $payment->save();

        return response()->json(['success' => true]);
    }

    // Fungsi untuk menghapus pembayaran
    public function destroy($id)
    {
        Payment::destroy($id);

        return redirect()->route('pemesanan.index')->with('success', 'Payment deleted successfully.');
    }

    public function print(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $payments = Payment::with('pesan.user', 'pesan.route')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get();

        $pdf = $this->pdf->loadView('admin.payment.print', compact('payments', 'month', 'year'));

        return $pdf->stream('payments-' . $month . '-' . $year . '.pdf');
    }
}
