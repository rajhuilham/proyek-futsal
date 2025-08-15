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
        Schema::create('bayars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_id')->references('id')->on('jadwals');
            $table->foreignId('sewa_id')->references('id')->on('sewas');
            $table->date('tanggal_bayar');
            $table->date('tanggal_lunas');
            $table->text('keterangan')->nullable();
            $table->integer('Dp');
            $table->integer('jumlah_bayar')->nullable();
            $table->integer('sisa_bayar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bayars');
    }
};
