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
