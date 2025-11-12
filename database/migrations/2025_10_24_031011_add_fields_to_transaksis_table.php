<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            if (!Schema::hasColumn('transaksis', 'metode_pembayaran')) {
                $table->string('metode_pembayaran', 50)->nullable()->after('total');
            }
            if (!Schema::hasColumn('transaksis', 'status')) {
                $table->string('status', 50)->default('pending')->after('metode_pembayaran');
            }
        });
    }

    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn(['metode_pembayaran', 'status']);
        });
    }
};
