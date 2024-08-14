<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Pesan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index()
    {
        $data['payments'] = Payment::with('pesan.user', 'pesan.route')->get(); // Memuat relasi yang diperlukan
        return view('admin.payment.index', $data);
    }
    
    public function updateStatus(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->status = $request->input('status');
        $payment->save();
    
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Payment::destroy($id);

        return redirect()->route('pemesanan.index')->with('success', 'Ticket type deleted successfully.');
    }
    
}
