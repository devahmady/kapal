<?php

namespace App\Http\Controllers\Home;

use App\Models\Bank;
use App\Models\Route;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PassengerType;
use App\Models\Transportation;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    public function index()
    {
        $data['bookings'] = Booking::where('user_id', Auth::id())->get();
        $data['routes']  = Route::all();
        $data['passengerTypes']  = PassengerType::all();
        $data['transportations']  = Transportation::all();
        $data['banks']  = Bank::all();
        $data['category']  = Category::all();
        $data['content'] = ['index'];
        return view('home.booking.template', $data);
    }

    // Menampilkan form untuk membuat booking baru
    public function create()
    {
        $data['routes']  = Route::all();
        $data['passengerTypes']  = PassengerType::all();
        $data['transportations']  = Transportation::all();
        $data['banks']  = Bank::all();
        $data['category']  = Category::all();
        return view('bookings.create', $data);
    }





    // Menampilkan form untuk mengedit booking
    public function edit(Booking $booking)
    {
        $data['routes']  = Route::all();
        $data['passengerTypes']  = PassengerType::all();
        $data['transportations']  = Transportation::all();
        $data['category']  = Category::all();

        if ($booking->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('bookings.edit', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'route_id' => 'required|exists:routes,id',
            'passenger_type_id' => 'required|exists:passenger_types,id',
            'transportation_id' => 'required|exists:transportations,id',
            'booking_date' => 'required|date',
            'total_price' => 'required|numeric|min:0',
            'status' => 'nullable|in:pending,confirmed,cancelled',
            'bank_id' => 'required|exists:banks,id', // Pastikan bank_id valid
            'category_id' => 'required|exists:categories,id', // Pastikan bank_id valid
        ]);

        $data['status'] = $data['status'] ?? 'pending';
        $data['user_id'] = Auth::id();

        // Simpan booking
        $booking = Booking::create($data);

        // Generate kode pemesanan acak
        $huruf = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $kodePemesanan = strtoupper(substr(str_shuffle($huruf), 0, 7));

        // Buat record pembayaran otomatis setelah booking
        Payment::create([
            'booking_id' => $booking->id . '-' . $kodePemesanan, // Gabungkan booking_id dengan kode acak
            'bank_id' => $data['bank_id'],
            'category_id' => $data['category_id'],
            'amount' => $data['total_price'],
            'payment_method' => 'Manual', // Anda bisa menyesuaikan atau menambah field ini jika diperlukan
            'status' => 'pending', // Status pembayaran bisa disesuaikan
            'user_id' => Auth::id(), // Simpan user_id
        ]);

        // Redirect ke halaman history pembayaran
        return redirect()->route('history.index')
            ->with('success', 'Booking berhasil dibuat dan pembayaran telah diproses.');
    }









    // Menghapus booking
    public function destroy(Booking $booking)
    {
        if ($booking->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dihapus.');
    }

    public function getPrice(Request $request)
    {
        $routeId = $request->input('route_id');
        $route = Route::find($routeId);

        if ($route) {
            $price = $route->price; // Asumsikan bahwa harga disimpan dalam field price
            return response()->json(['price' => $price]);
        }

        return response()->json(['error' => 'Invalid route'], 400); // Kode status 400 untuk permintaan yang tidak valid
    }
}
