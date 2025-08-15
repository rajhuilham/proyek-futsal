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
    Schema::table('jadwals', function (Blueprint $table) {
        // Tambahkan kolom baru
        $table->dateTime('start_datetime')->after('user_id');
        $table->dateTime('end_datetime')->after('start_datetime');

        // Hapus kolom lama
        $table->dropColumn(['booking_date', 'start_time', 'end_time']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            //
        });
    }
};
