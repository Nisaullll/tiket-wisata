<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KontakController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/tentang', [BerandaController::class, 'tentang'])->name('tentang');

Route::get('/destinasi', [DestinasiController::class, 'index'])->name('destinasi.index');
Route::get('/destinasi/{destinasi}', [DestinasiController::class, 'show'])->name('destinasi.show');

Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');

Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

// Route Transaksi & E-Ticket (Dikeluarkan dari middleware auth agar langsung bisa diuji dari beranda)
Route::post('/pesan-tiket', [DestinasiController::class, 'storeTiket'])->name('transaksi.store');
Route::post('/kirim-ulasan', [DestinasiController::class, 'storeUlasan'])->name('ulasan.store');
Route::get('/e-tiket/{id}', [DestinasiController::class, 'showTiket'])->name('transaksi.show');

// Route cadangan pengaman jika ada fungsi yang memanggil halaman login
Route::get('/login', function () {
    return redirect('/')->with('info', 'Silakan gunakan form pesanan langsung di beranda.');
})->name('login');