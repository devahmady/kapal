<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKendaraan extends Model
{
    use HasFactory;
    protected $guarded = [];
    // Relasi dengan Pesan
    public function pesan()
    {
        return $this->belongsTo(Pesan::class, 'pesan_id');
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }
}
