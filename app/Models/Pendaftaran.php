<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $fillable = [
        'user_id',
        'paket_travel_id',
        'ktp',
        'kk',
        'bukti',
        'catatan',
        'status',
    ];

    /**
     * Relasi ke tabel PaketTravel
     * (Setiap pendaftaran hanya untuk satu paket)
     */
    public function paketTravel()
    {
        return $this->belongsTo(PaketTravel::class, 'paket_travel_id');
    }

    /**
     * Relasi ke tabel User
     * (Setiap pendaftaran dimiliki oleh satu user)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke tabel Transaksi
     * (Satu pendaftaran bisa memiliki banyak transaksi)
     */
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'pendaftaran_id');
    }

    /**
     * Relasi ke tabel Pembayaran (jika digunakan)
     * (Satu pendaftaran bisa punya satu data pembayaran)
     */
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'pendaftaran_id');
    }
}
