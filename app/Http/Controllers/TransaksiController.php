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
<<<<<<< HEAD
        // Ambil data transaksi lengkap dengan relasi user, pendaftaran, dan paket travel
        $transaksis = Transaksi::with(['user', 'pendaftaran.paketTravel'])->latest()->get();

        // Hitung jumlah jamaah & paket untuk statistik (opsional)
        $jumlahJamaah = User::where('role', 'jamaah')->count();
        $jumlahPaket = PaketTravel::count();
=======
        $transaksis = Transaksi::with(['user', 'pendaftaran.paketTravel'])->latest()->get();
        $users = User::all();
        $pendaftarans = Pendaftaran::with(['paketTravel', 'user'])->get();
        $pakets = PaketTravel::all();

        // Daftar jamaah untuk dropdown
        $jamaahList = User::select('id', 'name')
            ->where('role', 'jamaah')
            ->orderBy('name')
            ->get();
>>>>>>> 961fc8259019e6948cce34e45fc51862ebdc4083

        return view('admin.transaksi.index', compact(
            'transaksis',
            'users',
            'pendaftarans',
            'pakets',
            'jamaahList'
        ));
    }

<<<<<<< HEAD
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
=======
    /**
     * 💾 Simpan transaksi baru
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'pendaftaran_id' => 'required|exists:pendaftarans,id',
            'total' => 'required|numeric|min:1',
            'metode_pembayaran' => 'required|string|max:50',
            'keterangan' => 'nullable|string|max:255',
        ]);

        try {
            Transaksi::create([
                'user_id' => $request->user_id,
                'pendaftaran_id' => $request->pendaftaran_id,
                'total' => $request->total,
                'metode_pembayaran' => $request->metode_pembayaran,
                'keterangan' => $request->keterangan,
                'status' => 'pending',
                'tanggal' => now(),
            ]);

            return redirect()->back()->with('success', 'Transaksi berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Gagal menambah transaksi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menambahkan transaksi.');
        }
    }

    /**
     * ✏️ Update nominal & metode pembayaran
     */
    public function updateNominal(Request $request, $id): RedirectResponse
>>>>>>> 961fc8259019e6948cce34e45fc51862ebdc4083
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1',
            'metode_pembayaran' => 'required|string|max:50',
        ]);

<<<<<<< HEAD
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'jumlah' => $request->jumlah,
            'jenis_pembayaran' => $request->jenis_pembayaran,
        ]);
=======
        try {
            $transaksi = Transaksi::findOrFail($id);
            $transaksi->update([
                'total' => $request->jumlah,
                'metode_pembayaran' => $request->metode_pembayaran,
            ]);
>>>>>>> 961fc8259019e6948cce34e45fc51862ebdc4083

            return redirect()->back()->with('success', 'Nominal transaksi berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal update nominal transaksi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui nominal.');
        }
    }

<<<<<<< HEAD
    // ➕ Tambah nominal (misalnya tabungan tambahan)
    public function tambahNominal(Request $request, $id)
=======
    /**
     * 💰 Tambah nominal (angsuran/tabungan)
     */
    public function tambahNominal(Request $request, $id): RedirectResponse
>>>>>>> 961fc8259019e6948cce34e45fc51862ebdc4083
    {
        $request->validate([
            'tambah_jumlah' => 'required|numeric|min:1',
            'metode_pembayaran' => 'required|string|max:50',
        ]);

        try {
            $transaksi = Transaksi::findOrFail($id);
            $transaksi->update([
                'total' => $transaksi->total + $request->tambah_jumlah,
                'metode_pembayaran' => $request->metode_pembayaran,
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

<<<<<<< HEAD
        return back()->with('success', 'Transaksi berhasil dihapus.');
=======
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
>>>>>>> 961fc8259019e6948cce34e45fc51862ebdc4083
    }
}
