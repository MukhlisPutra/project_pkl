<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   public function up(): void
{
    Schema::table('transaksis', function (Blueprint $table) {
        // Hapus foreign key dulu baru kolomnya
        if (Schema::hasColumn('transaksis', 'booking_id')) {
            $table->dropForeign(['booking_id']); // hapus relasi foreign key
            $table->dropColumn('booking_id');    // hapus kolom booking_id
        }
    });
}


    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_id')->nullable();
        });
    }
};
