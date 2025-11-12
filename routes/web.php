<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\JamaahDashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TestimoniController;
use App\Models\PaketTravel;
use App\Models\Testimoni;

/*
|--------------------------------------------------------------------------
| HOME & PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $pakets = PaketTravel::all();
    $testimonis = Testimoni::all();
    return view('jamaah.halamanutama', compact('pakets', 'testimonis'));
})->name('home');

// Public Pages
Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni');
Route::get('/paket/{id}', [PaketController::class, 'show'])->name('paket.show');

// Static Package Pages (Umrah & Haji)
Route::get('/paket-umrah-reguler', fn() => view('jamaah.paketumrahreguler'))->name('paket.umrah.reguler');
Route::get('/paket-umrah-turki', fn() => view('jamaah.paketumrahturki'))->name('paket.umrah.turki');
Route::get('/paket-haji-khusus', fn() => view('jamaah.pakethajikhusus'))->name('paket.haji.khusus');
Route::get('/paket-umrah-ramadhan', fn() => view('jamaah.paketumrahramadhan'))->name('paket.umrah.ramadhan');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| JAMAAH ROUTES (Middleware: auth, jamaah)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'jamaah'])->group(function () {
    // Dashboard & Portal
    Route::get('/jamaah/dashboard', [JamaahDashboardController::class, 'index'])->name('jamaah.dashboard');
    Route::get('/jamaah/portal', fn() => view('jamaah.portal'))->name('jamaah.portal');

    // Pendaftaran (Booking)
    Route::get('/pendaftaran/{paket}', [PendaftaranController::class, 'create'])->name('pendaftaran.form');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

    // Transaksi Detail
    Route::get('/jamaah/transaksi/{id}', [JamaahDashboardController::class, 'showTransaksi'])->name('jamaah.transaksi.show');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (Middleware: auth, admin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Pendaftar Management
    Route::get('/admin/pendaftar', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::post('/admin/pendaftar/{id}/verifikasi', [PendaftaranController::class, 'verifikasi'])->name('pendaftaran.verifikasi');
    Route::post('/admin/pendaftaran/{id}/acc', [AdminController::class, 'accPendaftaran'])->name('admin.pendaftaran.acc');
    Route::post('/admin/pendaftaran/{id}/tolak', [AdminController::class, 'tolakPendaftaran'])->name('admin.pendaftaran.tolak');

    // CRUD - Paket
    Route::post('/paket', [AdminController::class, 'storePaket'])->name('paket.store');
    Route::put('/paket/{id}', [AdminController::class, 'updatePaket'])->name('paket.update');
    Route::delete('/paket/{id}', [AdminController::class, 'destroyPaket'])->name('paket.destroy');

    // CRUD - Jamaah
    Route::post('/jamaah', [AdminController::class, 'storeJamaah'])->name('jamaah.store');
    Route::put('/jamaah/{id}', [AdminController::class, 'updateJamaah'])->name('jamaah.update');
    Route::delete('/jamaah/{id}', [AdminController::class, 'destroyJamaah'])->name('jamaah.destroy');

    // CRUD - Karyawan
    Route::post('/karyawan', [AdminController::class, 'storeKaryawan'])->name('karyawan.store');
    Route::put('/karyawan/{id}', [AdminController::class, 'updateKaryawan'])->name('karyawan.update');
    Route::delete('/karyawan/{id}', [AdminController::class, 'destroyKaryawan'])->name('karyawan.destroy');

    // CRUD - Agent
    Route::post('/agent', [AdminController::class, 'storeAgent'])->name('agent.store');
    Route::put('/agent/{id}', [AdminController::class, 'updateAgent'])->name('agent.update');
    Route::delete('/agent/{id}', [AdminController::class, 'destroyAgent'])->name('agent.destroy');

    // Transaksi Management (Index, Store, Update, Delete)
    // NOTE: updateNominal and tambahNominal are moved here as they logically require admin-level permissions.
    Route::prefix('admin/transaksi')->group(function () {
    Route::get('/', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/edit/{id}', [TransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::put('/update/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::delete('/delete/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
});
    // Invoice Generation & Admin Settings
    Route::get('/admin/invoice/{pendaftaran}', [InvoiceController::class, 'create'])->name('invoice.create');
    Route::post('/admin/ubah-password', [AdminController::class, 'ubahPassword'])->name('admin.ubahPassword');
});
// ====================
// Rute Transaksi
// ====================


Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::patch('/transaksi/{id}/updateNominal', [TransaksiController::class, 'updateNominal'])->name('transaksi.updateNominal');
Route::patch('/transaksi/{id}/tambahNominal', [TransaksiController::class, 'tambahNominal'])->name('transaksi.tambahNominal');
Route::patch('/transaksi/{id}/updateStatus', [TransaksiController::class, 'updateStatus'])->name('transaksi.updateStatus');
Route::delete('/transaksi/{id}/destroy', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::patch('/transaksi/{id}/update-nominal', [TransaksiController::class, 'updateNominal'])->name('transaksi.updateNominal');
    Route::patch('/transaksi/{id}/tambah-nominal', [TransaksiController::class, 'tambahNominal'])->name('transaksi.tambahNominal');
    Route::patch('/transaksi/{id}/status', [TransaksiController::class, 'updateStatus'])->name('transaksi.updateStatus');
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
});
use App\Http\Controllers\ChatController;

Route::middleware(['auth'])->group(function () {
    Route::get('/jamaah/chat', [ChatController::class, 'index'])->name('jamaah.chat');
    Route::post('/jamaah/chat/send', [ChatController::class, 'send'])->name('jamaah.chat.send');
});
use App\Http\Controllers\AdminChatController;

Route::prefix('admin/chat')->group(function() {
    Route::get('/', [AdminChatController::class, 'index'])->name('admin.chat');
    Route::get('/{user}', [AdminChatController::class, 'show'])->name('admin.chat.show');
    Route::post('/send', [AdminChatController::class, 'send'])->name('admin.chat.send');
    Route::get('/fetch/{userId}', [AdminChatController::class, 'fetchMessages']); // untuk AJAX polling
});
