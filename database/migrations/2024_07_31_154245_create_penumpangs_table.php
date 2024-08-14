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
        Schema::create('penumpangs', function (Blueprint $table) {
            $table->id();
            $table->string('level');
            $table->decimal('harga', 8, 2);
            $table->unsignedBigInteger('ticket_type_id');
            $table->timestamps();
        
            
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penumpangs');
    }
};
