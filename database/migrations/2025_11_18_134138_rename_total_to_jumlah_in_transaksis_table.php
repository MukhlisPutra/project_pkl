<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations (Mengganti 'total' menjadi 'jumlah').
     */
    public function up(): void
    {
        // Pastikan kolom 'total' ada sebelum diganti namanya
        Schema::table('transaksis', function (Blueprint $table) {
            $table->renameColumn('total', 'jumlah');
        });
    }

    /**
     * Reverse the migrations (Mengembalikan 'jumlah' menjadi 'total').
     */
    public function down(): void
    {
        // Operasi kebalikan dari 'up'
        Schema::table('transaksis', function (Blueprint $table) {
            $table->renameColumn('jumlah', 'total');
        });
    }
};