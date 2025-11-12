<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'user_id',
        'paket_id', // gunakan ini sebagai foreign key paket
        'nama',
        'hp',
        'email',
        'ktp',
        'kk',
        'bukti',
        'catatan',
        'status',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke PaketTravel
     */
    public function paketTravel()
    {
        return $this->belongsTo(PaketTravel::class, 'paket_id'); // pastikan pakai kolom paket_id
    }

    /**
     * Relasi ke Transaksi
     */
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'booking_id');
    }
}
