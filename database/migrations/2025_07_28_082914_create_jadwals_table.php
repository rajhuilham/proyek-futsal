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
        // Nama tabel diubah menjadi 'bookings' (jamak & bahasa Inggris)
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            // foreignId disederhanakan dengan constrained()
            $table->foreignId('lapangan_id')->constrained('lapangans'); 
            $table->foreignId('user_id')->constrained('users');
            
            // Nama kolom diubah menjadi snake_case & bahasa Inggris
            $table->date('booking_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedInteger('price'); // Harga saat booking terjadi

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};