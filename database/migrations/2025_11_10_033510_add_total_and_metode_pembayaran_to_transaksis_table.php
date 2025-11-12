<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            // Tambah kolom total kalau belum ada
            if (!Schema::hasColumn('transaksis', 'total')) {
                $table->decimal('total', 15, 2)->after('pendaftaran_id')->default(0);
            }

            // Tambah kolom metode_pembayaran kalau belum ada
            if (!Schema::hasColumn('transaksis', 'metode_pembayaran')) {
                $table->string('metode_pembayaran')->after('total')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            if (Schema::hasColumn('transaksis', 'total')) {
                $table->dropColumn('total');
            }

            if (Schema::hasColumn('transaksis', 'metode_pembayaran')) {
                $table->dropColumn('metode_pembayaran');
            }
        });
    }
};
