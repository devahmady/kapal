<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;
    protected $guarded = [];
       // Relasi dengan User
       public function user()
       {
           return $this->belongsTo(User::class);
       }
   
       // Relasi dengan Penumpang
       public function penumpang()
       {
           return $this->belongsTo(Penumpang::class);
       }
   
       // Relasi dengan Kendaraan
       public function kendaraan()
       {
           return $this->belongsTo(Kendaraan::class);
       }
   
       // Relasi dengan DataKendaraan
       public function dataKendaraan()
       {
           return $this->hasMany(DataKendaraan::class, 'pesan_id');
       }
       
       public function dataPenumpang()
       {
           return $this->hasMany(DataPenumpang::class, 'pesan_id');
       }
       
   
       // Relasi dengan Route
       public function route()
       {
           return $this->belongsTo(Route::class);
       }
   
       // Relasi dengan Bank
       public function bank()
       {
           return $this->belongsTo(Bank::class);
       }
   
       // Relasi dengan Data Kendaraan
       public function dataKendaraans()
       {
           return $this->hasMany(DataKendaraan::class);
       }
   
       // Relasi dengan Data Penumpang
       public function dataPenumpangs()
       {
           return $this->hasMany(DataPenumpang::class);
       }
       public function payments()
       {
           return $this->hasMany(Payment::class, 'pesan_id');
       }
}
