<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesanDetails extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function pesan()
{
    return $this->belongsTo(Pesan::class);
}

public function kendaraan()
{
    return $this->belongsTo(Kendaraan::class);
}
public function penumpang()
{
    return $this->belongsTo(Penumpang::class);
}
}
