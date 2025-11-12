<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal')->default(now());
            $table->unsignedBigInteger('user_id')->nullable(); // kasir / admin
            $table->decimal('total', 15, 2)->default(0);
            $table->string('metode_pembayaran')->nullable(); // tunai / qris / transfer
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // relasi ke users (opsional)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
