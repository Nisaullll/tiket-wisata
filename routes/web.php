<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Admin\TendaController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Middleware\AdminOnly;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/tentang', [BerandaController::class, 'tentang'])->name('tentang');

Route::get('/destinasi', [DestinasiController::class, 'index'])->name('destinasi.index');
Route::get('/destinasi/{destinasi}', [DestinasiController::class, 'show'])->name('destinasi.show');

Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');

Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/ulasan', function () {
        $ulasanList = Ulasan::latest()->get();
        $totalTiket = Transaksi::count();
        $totalUlasan = Ulasan::count();
        $rataRating = Ulasan::avg('rating') ? number_format(Ulasan::avg('rating'), 1) : '5.0';

        return view('ulasan.index', compact('ulasanList', 'totalTiket', 'totalUlasan', 'rataRating'));
    })->name('ulasan.index');

    Route::post('/kirim-ulasan', [KontakController::class, 'store'])->name('ulasan.store');

    Route::get('/tenda/booking', function () {
        return view('tenda.booking');
    })->name('tenda.booking');

    Route::post('/pesan-tiket', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/e-tiket/{id}', [TransaksiController::class, 'showTiket'])->name('transaksi.show');

    Route::post('/transaksi/{id}/upload-bukti', [TransaksiController::class, 'uploadBukti'])->name('transaksi.upload');

    Route::get('/laporan-tiket', function () {
        $riwayatTransaksi = Transaksi::where('user_id', Auth::id())->latest()->get();
        return view('transaksi.laporan', compact('riwayatTransaksi'));
    })->name('transaksi.laporan');
});

Route::middleware(['auth', AdminOnly::class])->group(function () {
    Route::get('/admin/laporan', function () {
        $transaksiList = Transaksi::with('user')->latest()->get();
        $ulasanListAdmin = Ulasan::latest()->get();

        return view('admin.laporan', compact('transaksiList', 'ulasanListAdmin'));
    })->name('admin.laporan');

    Route::put('/admin/transaksi/{id}/lunas', function ($id) {
        $trx = Transaksi::findOrFail($id);
        $trx->update(['status' => 'lunas']);
        return back()->with('success', 'Status pembayaran berhasil dikonfirmasi lunas!');
    })->name('admin.transaksi.lunas');

    Route::post('/admin/fasilitas', [FasilitasController::class, 'store'])->name('admin.fasilitas.store');
    Route::post('/admin/tenda', [TendaController::class, 'store'])->name('admin.tenda.store');
    Route::delete('/admin/tenda/{id}', [TendaController::class, 'destroy'])->name('admin.tenda.destroy');

    Route::post('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
    Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::put('/admin/galeri/{id}', [GaleriController::class, 'update'])->name('admin.galeri.update');
    Route::delete('/admin/galeri/{id}', [GaleriController::class, 'destroy'])->name('admin.galeri.destroy');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

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
})->middleware('throttle:5,1');

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

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');