<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Jika tabel 'transaksis' belum ada, buat dulu
        if (!Schema::hasTable('transaksis')) {
            Schema::create('transaksis', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->unsignedBigInteger('pendaftaran_id')->nullable();
                $table->unsignedBigInteger('booking_id')->nullable();
                $table->decimal('jumlah', 15, 2)->default(0);
                $table->string('status')->default('pending');
                $table->timestamps();

                // Relasi opsional
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('pendaftaran_id')->references('id')->on('pendaftarans')->onDelete('cascade');
                $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            });
        } else {
            // Kalau tabel sudah ada, tambahkan kolom jika belum ada
            Schema::table('transaksis', function (Blueprint $table) {
                if (!Schema::hasColumn('transaksis', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable()->after('id');
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                }

                if (!Schema::hasColumn('transaksis', 'pendaftaran_id')) {
                    $table->unsignedBigInteger('pendaftaran_id')->nullable()->after('user_id');
                    $table->foreign('pendaftaran_id')->references('id')->on('pendaftarans')->onDelete('cascade');
                }

                if (!Schema::hasColumn('transaksis', 'booking_id')) {
                    $table->unsignedBigInteger('booking_id')->nullable()->after('pendaftaran_id');
                    $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
                }

                if (!Schema::hasColumn('transaksis', 'jumlah')) {
                    $table->decimal('jumlah', 15, 2)->default(0)->after('booking_id');
                }

                if (!Schema::hasColumn('transaksis', 'status')) {
                    $table->string('status')->default('pending')->after('jumlah');
                }
            });
        }
    }

    public function down()
    {
        // Rollback aman
        if (Schema::hasTable('transaksis')) {
            Schema::table('transaksis', function (Blueprint $table) {
                if (Schema::hasColumn('transaksis', 'user_id')) {
                    $table->dropForeign(['user_id']);
                    $table->dropColumn('user_id');
                }
                if (Schema::hasColumn('transaksis', 'pendaftaran_id')) {
                    $table->dropForeign(['pendaftaran_id']);
                    $table->dropColumn('pendaftaran_id');
                }
                if (Schema::hasColumn('transaksis', 'booking_id')) {
                    $table->dropForeign(['booking_id']);
                    $table->dropColumn('booking_id');
                }
                if (Schema::hasColumn('transaksis', 'jumlah')) {
                    $table->dropColumn('jumlah');
                }
                if (Schema::hasColumn('transaksis', 'status')) {
                    $table->dropColumn('status');
                }
            });
        }
    }
};
