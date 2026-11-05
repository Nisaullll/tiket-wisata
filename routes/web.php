<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\TransaksiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/tentang', [BerandaController::class, 'tentang'])->name('tentang');

Route::get('/destinasi', [DestinasiController::class, 'index'])->name('destinasi.index');
Route::get('/destinasi/{destinasi}', [DestinasiController::class, 'show'])->name('destinasi.show');

// ================= RUTE GALERI (LENGKAP CRUD) =================
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
Route::post('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update');
Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');
// ==============================================================

Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

// Route Transaksi & E-Ticket (Wajib login untuk memesan tiket)
Route::middleware(['auth'])->group(function () {
    Route::post('/pesan-tiket', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/e-tiket/{id}', [TransaksiController::class, 'showTiket'])->name('transaksi.show');
});

Route::post('/kirim-ulasan', [DestinasiController::class, 'storeUlasan'])->name('ulasan.store');

// Route Login (Menampilkan form login dari views/login.blade.php)
Route::get('/login', function () {
    return view('login');
})->name('login');

// Proses autentikasi login
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/')->with('success', 'Berhasil login!');
    }

    return back()->withErrors([
        'email' => 'Email atau password yang Anda masukkan salah.',
    ])->onlyInput('email');
});

// ================= RUTE REGISTER / PENDAFTARAN AKUN BARU =================
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

    return redirect('/')->with('success', 'Akun berhasil dibuat! Selamat datang, ' . $user->name);
})->name('register.store');
// ======================================================================

// Proses Logout / Ganti Akun
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');