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
        Schema::create('konfirmasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sewa_id')->references('id')->on('sewas');
            $table->date('tanggal_konfirmasi');
            $table->string('Atas_nama');
            $table->text('Keterangan')->nullable();
            $table->text('Bukti_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konfirmasis');
    }
};
