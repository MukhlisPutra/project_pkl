<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Tambah kolom password ke tabel jamaahs.
     */
    public function up(): void
    {
        // Pastikan tabel 'jamaahs' memang ada
        if (Schema::hasTable('jamaahs')) {
            // Tambahkan kolom 'password' hanya jika belum ada
            if (!Schema::hasColumn('jamaahs', 'password')) {
                Schema::table('jamaahs', function (Blueprint $table) {
                    // Hindari after('email') karena bisa error jika kolom email tidak ada
                    $table->string('password')->nullable();
                });
            }

            // Isi default password untuk semua data lama (opsional)
            try {
                DB::table('jamaahs')->update(['password' => bcrypt('default123')]);
            } catch (\Exception $e) {
                // Jika tabel kosong atau belum siap, abaikan error
            }
        }
    }

    /**
     * Hapus kolom password jika rollback.
     */
    public function down(): void
    {
        if (Schema::hasTable('jamaahs') && Schema::hasColumn('jamaahs', 'password')) {
            Schema::table('jamaahs', function (Blueprint $table) {
                $table->dropColumn('password');
            });
        }
    }
};
