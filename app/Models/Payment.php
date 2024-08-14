<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pesan()
    {
        return $this->belongsTo(Pesan::class, 'pesan_id');
    }
    
}
