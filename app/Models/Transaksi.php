<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pendaftaran_id',
        'jumlah',
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
        return $this->belongsTo(Pendaftaran::class);
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
