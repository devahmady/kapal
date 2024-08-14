<?php

namespace App\Models;

use App\Models\Transportation;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id','user_id', 'route_id', 'passenger_type_id', 'transportation_id', 'booking_date', 'total_price', 'status', 'bank_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function passengerType()
    {
        return $this->belongsTo(PassengerType::class);
    }

    public function transportation()
    {
        return $this->belongsTo(Transportation::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
}
