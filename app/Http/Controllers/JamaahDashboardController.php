<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;
use App\Models\PaketTravel;
use App\Models\Transaksi;

class JamaahDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil pendaftaran terakhir jamaah (kalau ada)
        $pendaftaran = Pendaftaran::with('paketTravel')
            ->where('user_id', $user->id)
            ->latest()
            ->first();

        // Inisialisasi nilai default agar tidak undefined
        $totalLunas = 0;
        $totalPending = 0;
        $totalDP = 0;
        $totalTabungan = 0;
        $totalPembayaran = 0;

        // Kalau user punya pendaftaran, baru hitung transaksi
        if ($pendaftaran) {
            $totalLunas = Transaksi::where('user_id', $user->id)
                ->where('status', 'acc')
                ->sum('total');

            $totalPending = Transaksi::where('user_id', $user->id)
                ->where('status', 'pending')
                ->sum('total');

            $totalDP = Transaksi::where('user_id', $user->id)
                ->where('keterangan', 'like', '%DP%')
                ->sum('total');

            $totalTabungan = Transaksi::where('user_id', $user->id)
                ->where('keterangan', 'like', '%Tabungan%')
                ->sum('total');

            // Hitung total keseluruhan
            $totalPembayaran = $totalLunas + $totalDP + $totalTabungan;
        }

        // Ambil semua riwayat pendaftaran
        $riwayat = Pendaftaran::with('paketTravel')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil 4 paket terbaru
        $pakets = PaketTravel::latest()->take(4)->get();

        return view('jamaah.dashboard', compact(
            'user',
            'pendaftaran',
            'totalPembayaran',
            'totalLunas',
            'totalPending',
            'totalDP',
            'totalTabungan',
            'riwayat',
            'pakets'
        ));
    }
}
