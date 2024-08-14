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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('route_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('passenger_type_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('transportation_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('bank_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->constrained()->onDelete('cascade');
            $table->date('booking_date');
            $table->decimal('total_price', 8, 2);
            $table->enum('status', ['pending', 'confirmed', 'cancelled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
