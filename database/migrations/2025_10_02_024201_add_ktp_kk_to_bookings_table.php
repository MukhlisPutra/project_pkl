<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk menambahkan kolom ktp dan kk ke tabel bookings.
     */
    public function up(): void
    {
        // Pastikan tabel bookings ada sebelum mengubahnya
        if (Schema::hasTable('bookings')) {
            Schema::table('bookings', function (Blueprint $table) {
                // Tambahkan kolom ktp hanya jika belum ada
                if (!Schema::hasColumn('bookings', 'ktp')) {
                    $table->string('ktp')->nullable()->after('paket');
                }

                // Tambahkan kolom kk hanya jika belum ada
                if (!Schema::hasColumn('bookings', 'kk')) {
                    $table->string('kk')->nullable()->after('ktp');
                }
            });
        }
    }

    /**
     * Rollback migrasi: hapus kolom ktp dan kk jika ada.
     */
    public function down(): void
    {
        // Pastikan tabel bookings ada sebelum menghapus kolom
        if (Schema::hasTable('bookings')) {
            Schema::table('bookings', function (Blueprint $table) {
                if (Schema::hasColumn('bookings', 'ktp')) {
                    $table->dropColumn('ktp');
                }
                if (Schema::hasColumn('bookings', 'kk')) {
                    $table->dropColumn('kk');
                }
            });
        }
    }
};
