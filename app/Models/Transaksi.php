<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'tanggal',
        'user_id',
        'pendaftaran_id',
        'jumlah',               // versi terbaru yang benar
        'metode_pembayaran',
        'keterangan',
        'status',
        'jenis_pembayaran',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke pendaftaran
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }

    // Relasi ke paket travel melalui pendaftaran
    public function paketTravel()
    {
        return $this->hasOneThrough(
            PaketTravel::class,
            Pendaftaran::class,
            'id',               // Foreign key di tabel pendaftarans
            'id',               // Foreign key di tabel paket_travels
            'pendaftaran_id',   // Foreign key di tabel transaksis
            'paket_travel_id'   // Foreign key di tabel pendaftarans
        );
    }
}
