<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pendaftaran;
use App\Models\PaketTravel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    // 📋 Tampilkan semua transaksi (khusus admin)
    public function index()
    {
        // Ambil data transaksi lengkap dengan relasi user, pendaftaran, dan paket travel
        $transaksis = Transaksi::with(['user', 'pendaftaran.paketTravel'])->latest()->get();

        // Hitung jumlah jamaah & paket untuk statistik (opsional)
        $jumlahJamaah = User::where('role', 'jamaah')->count();
        $jumlahPaket = PaketTravel::count();

        return view('admin.dashboard', compact('transaksis', 'jumlahJamaah', 'jumlahPaket'));
    }

    // 💾 Simpan transaksi baru (misalnya setelah pendaftaran disetujui)
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jumlah' => 'required|numeric|min:0',
            'status' => 'required|string|in:pending,acc,ditolak',
        ]);

        // Cari pendaftaran terakhir milik user
        $pendaftaran = Pendaftaran::where('user_id', $request->user_id)->latest()->first();

        // Pastikan pendaftaran ditemukan
        if (!$pendaftaran) {
            return back()->with('error', 'User belum memiliki pendaftaran aktif.');
        }

        // Simpan transaksi baru
        Transaksi::create([
            'user_id' => $request->user_id,
            'pendaftaran_id' => $pendaftaran->id,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Transaksi berhasil ditambahkan.');
    }

    // ✅ Update status transaksi (disetujui / ditolak oleh admin)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,acc,ditolak',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status transaksi berhasil diperbarui.');
    }

    // 💰 Update nominal transaksi (edit manual)
    public function updateNominal(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:0',
            'jenis_pembayaran' => 'required|in:dp,tabungan,lunas',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'jumlah' => $request->jumlah,
            'jenis_pembayaran' => $request->jenis_pembayaran,
        ]);

        return back()->with('success', 'Nominal transaksi berhasil diperbarui.');
    }

    // ➕ Tambah nominal (misalnya tabungan tambahan)
    public function tambahNominal(Request $request, $id)
    {
        $request->validate([
            'tambah_jumlah' => 'required|numeric|min:1',
            'jenis_pembayaran' => 'required|in:tabungan,lunas',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->jumlah += $request->tambah_jumlah;
        $transaksi->jenis_pembayaran = $request->jenis_pembayaran;
        $transaksi->save();

        return back()->with('success', 'Nominal tambahan berhasil ditambahkan.');
    }

    // ❌ Hapus transaksi
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return back()->with('success', 'Transaksi berhasil dihapus.');
    }
}
