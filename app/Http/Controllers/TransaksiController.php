<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pendaftaran;
use App\Models\PaketTravel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

class TransaksiController extends Controller
{
    /**
     * 📋 Tampilkan semua transaksi (halaman admin)
     */
    public function index()
    {
        try {
            $transaksis = Transaksi::with(['user', 'pendaftaran.paketTravel'])->latest()->get();

            // Dropdown jamaah
            $jamaahList = User::select('id', 'name')
                ->where('role', 'jamaah')
                ->orderBy('name')
                ->get();

            // Data pendaftaran
            $pendaftarans = Pendaftaran::with(['paketTravel', 'user'])->get();

            return view('admin.transaksi.index', compact(
                'transaksis',
                'pendaftarans',
                'jamaahList'
            ));
        } catch (\Exception $e) {
            Log::error('Gagal memuat data transaksi di index: ' . $e->getMessage());
            return view('admin.transaksi.index', [
                'transaksis' => collect(),
                'jamaahList' => collect(),
                'pendaftarans' => collect(),
            ])->with('error', 'Gagal memuat data transaksi. Cek log server.');
        }
    }

    /**
     * 💾 Simpan transaksi baru
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'pendaftaran_id' => 'required|exists:pendaftarans,id',
            'jumlah' => 'required|numeric|min:1',
            'metode_pembayaran' => 'required|string|max:50',
            'keterangan' => 'nullable|string|max:255',
        ]);

        try {
            Transaksi::create([
                'user_id' => $validated['user_id'],
                'pendaftaran_id' => $validated['pendaftaran_id'],
                'jumlah' => $validated['jumlah'],
                'metode_pembayaran' => $validated['metode_pembayaran'],
                'keterangan' => $validated['keterangan'],
                'status' => 'acc',
                'tanggal' => now(),
            ]);

            return redirect()->back()->with('success', 'Transaksi berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Gagal menambah transaksi: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan transaksi.');
        }
    }

    /**
     * ✏️ Update nominal & metode pembayaran
     */
    public function updateNominal(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'jumlah' => 'required|numeric|min:1',
            'metode_pembayaran' => 'required|string|max:50',
        ]);

        try {
            $transaksi = Transaksi::findOrFail($id);
            $transaksi->update([
                'jumlah' => $validated['jumlah'],
                'metode_pembayaran' => $validated['metode_pembayaran'],
            ]);

            return redirect()->back()->with('success', 'Nominal transaksi berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal update nominal transaksi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui nominal.');
        }
    }

    /**
     * 💰 Tambah nominal (angsuran/tabungan)
     */
    public function tambahNominal(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'tambah_jumlah' => 'required|numeric|min:1',
            'metode_pembayaran' => 'required|string|max:50',
        ]);

        try {
            $transaksi = Transaksi::findOrFail($id);

            $transaksi->update([
                'jumlah' => $transaksi->jumlah + $validated['tambah_jumlah'],
                'metode_pembayaran' => $validated['metode_pembayaran'],
            ]);

            return redirect()->back()->with('success', 'Nominal berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Gagal menambah nominal transaksi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menambah nominal.');
        }
    }

    /**
     * 🔄 Update status transaksi
     */
    public function updateStatus(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:pending,acc,tolak',
        ]);

        try {
            $transaksi = Transaksi::findOrFail($id);
            $transaksi->update(['status' => $request->status]);

            return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal update status transaksi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui status.');
        }
    }

    /**
     * 🗑️ Hapus transaksi
     */
    public function destroy($id): RedirectResponse
    {
        try {
            $transaksi = Transaksi::findOrFail($id);
            $transaksi->delete();

            return redirect()->back()->with('success', 'Transaksi berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus transaksi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus transaksi.');
        }
    }
}
