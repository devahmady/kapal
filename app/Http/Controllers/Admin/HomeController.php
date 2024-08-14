<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil semua payment dengan status 'confirmed'
        $confirmedPayments = Payment::where('status', 'completed')->get();

        // Mengambil semua payment dengan status 'pending'
        $pendingPayments = Payment::where('status', 'pending')->get();

        // Menghitung jumlah total_amount dari payment yang berstatus 'completed'
        $totalConfirmedPrice = $confirmedPayments->sum('amount');

        // Menghitung jumlah total_amount dari payment yang berstatus 'pending'
        $totalPendingPrice = $pendingPayments->sum('amount'); // Pastikan kolom 'amount' ada di database

        // Mengirim data ke view
        $data['confirmed'] = $confirmedPayments;
        $data['pending'] = $pendingPayments;
        $data['totalConfirmedPrice'] = $totalConfirmedPrice;
        $data['totalPendingPrice'] = $totalPendingPrice;

        return view('admin.dashboard.index', $data);
    }
}
