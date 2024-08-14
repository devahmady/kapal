<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penumpang extends Model
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
}
