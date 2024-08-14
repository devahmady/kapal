<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesans', function (Blueprint $table) {
            $table->id();
            $table->date('booking');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('penumpang_id')->nullable();
            $table->unsignedBigInteger('kendaraan_id')->nullable();
            $table->unsignedBigInteger('data_kendaraan_id')->nullable();
            $table->unsignedBigInteger('data_penumpang_id')->nullable();
            $table->unsignedBigInteger('route_id');
            $table->unsignedBigInteger('bank_id');
            $table->integer('jumlah_tiket');
            $table->decimal('total_harga', 10, 2);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesans');
    }
};
