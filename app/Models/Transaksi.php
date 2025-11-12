<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'tanggal',
        'user_id',
        'pendaftaran_id',
<<<<<<< HEAD
        'jumlah',
=======
        'total',
        'metode_pembayaran',
        'keterangan',
>>>>>>> 961fc8259019e6948cce34e45fc51862ebdc4083
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
<<<<<<< HEAD

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
=======
>>>>>>> 961fc8259019e6948cce34e45fc51862ebdc4083
}
