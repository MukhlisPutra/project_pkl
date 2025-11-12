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

        if ($pendaftaran) {
            // Ambil semua transaksi yang terkait pendaftaran ini dan tidak batal
            $transaksis = Transaksi::where('user_id', $user->id)
                ->where('pendaftaran_id', $pendaftaran->id)
                ->where('status', '!=', 'batal')
                ->get();

            // Hitung total keseluruhan
            $totalPembayaran = $transaksis->sum('total');

            // Opsional: pisahkan kategori untuk laporan detail
            $totalLunas = $transaksis->where('status', 'acc')->sum('total');
            $totalPending = $transaksis->where('status', 'pending')->sum('total');
            $totalDP = $transaksis->filter(fn($t) => str_contains($t->keterangan, 'DP'))->sum('total');
            $totalTabungan = $transaksis->filter(fn($t) => str_contains($t->keterangan, 'Tabungan'))->sum('total');
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

    public function showTransaksi($id)
    {
        $user = Auth::user();

        $pendaftaran = Pendaftaran::with('paketTravel')
            ->where('user_id', $user->id)
            ->findOrFail($id);

        // Ambil transaksi khusus untuk pendaftaran ini
        $transaksi = Transaksi::where('user_id', $user->id)
            ->where('pendaftaran_id', $id)
            ->where('status', '!=', 'batal') // optional, abaikan transaksi batal
            ->get();

        return view('jamaah.transaksi_show', compact('pendaftaran', 'transaksi'));
    }
}
