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
        // Tambahkan kolom 'gambar' hanya jika belum ada
        if (!Schema::hasColumn('paket_travels', 'gambar')) {
            Schema::table('paket_travels', function (Blueprint $table) {
                $table->string('gambar')->nullable()->after('tanggal_berangkat');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus kolom 'gambar' hanya jika ada
        if (Schema::hasColumn('paket_travels', 'gambar')) {
            Schema::table('paket_travels', function (Blueprint $table) {
                $table->dropColumn('gambar');
            });
        }
    }
};
