<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Booking; // Pastikan ini diimpor
use App\Models\Bank; // Import model Bank jika digunakan

class PaymentMethodsTableSeeder extends Seeder
{
    public function run(): void
    {
        $bookings = Booking::all();
        $banks = Bank::all();

        foreach ($bookings as $booking) {
            DB::table('payments')->insert([
                'booking_id' => $booking->id,
                'bank_id' => $banks->random()->id, // Pilih bank secara acak dari daftar
                'payment_method' => 'Credit Card',
                'amount' => $booking->total_price,
                'status' => 'pending',
            ]);
        }
    }
}
