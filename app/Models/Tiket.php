<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;
    protected $guarded = [''];

   // Relasi dengan Penumpang
   public function penumpangs()
   {
       return $this->hasMany(Penumpang::class);
   }

   // Relasi dengan Kendaraan
   public function kendaraan()
   {
       return $this->hasMany(Kendaraan::class);
   }
}
