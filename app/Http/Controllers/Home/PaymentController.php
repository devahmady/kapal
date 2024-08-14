<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Pesan;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index($id)
    {
        // Ambil data pemesanan berdasarkan ID dan termasuk relasi payments
        $data['pesan'] = Pesan::find($id);
        $data['content'] = ['index'];
        return view('home.payment.template', $data);
    }


    // Menampilkan halaman proses pembayaran
    public function payment($id)
    {
        $data['pesan'] = Pesan::findOrFail($id);
        $data['pesans'] = Pesan::where('id', $id)->get();
        $data['content'] = ['payment'];
        return view('home.payment.template', $data);
    }

    public function process(Request $request)
    {
        // Validasi input
        $request->validate([
            'pesan_id' => 'required|exists:pesans,id',
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
        ]);

        // Membuat entri pembayaran baru
        $payment = Payment::create([
            'pesan_id' => $request->input('pesan_id'),
            'amount' => $request->input('amount'),
            'payment_method' => $request->input('payment_method'),
            'status' => 'pending',
        ]);

        // Redirect ke halaman detail pembayaran dengan ID pesan
        return redirect()->route('pesan.show', ['id' => $request->input('pesan_id')])
            ->with('success', 'Pembayaran berhasil diproses. Lihat histori pemesanan Anda.');
    }


    public function updateStatus(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        // Optionally validate the status value
        $request->validate([
            'status' => 'required|in:pending,completed,failed',
        ]);

        $payment->status = $request->input('status');
        $payment->save();

        return response()->json(['success' => true, 'status' => $payment->status]);
    }
}
