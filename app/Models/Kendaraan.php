<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Relasi dengan Tiket
    public function tiket()
    {
        return $this->belongsTo(Tiket::class, 'ticket_type_id');
    }

    // Relasi dengan Pesan
    public function pesans()
    {
        return $this->hasMany(Pesan::class);
    }

    // Relasi dengan Data Kendaraan
    public function dataKendaraans()
    {
        return $this->hasMany(DataKendaraan::class);
    }
    public function dataPenumpangs()
    {
        return $this->hasMany(DataPenumpang::class, 'kendaraan_id');
    }
}
