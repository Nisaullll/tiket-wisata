<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Menampilkan halaman form login khusus admin
    public function showLoginForm()
    {
        return view('admin-login');
    }

    // Memproses data autentikasi login admin
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Pastikan user yang login adalah admin dan langsung arahkan ke halaman laporan/panel admin
            if (Auth::user()->usertype === 'admin') {
                return redirect()->route('admin.laporan')->with('success', 'Berhasil login!');
            }

            // Jika bukan admin, keluarkan kembali (logout)
            Auth::logout();
            return back()->withErrors([
                'email' => 'Akses ditolak. Akun Anda bukan Administrator.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Memproses logout khusus admin / sesi terkait
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Berhasil logout dari sistem.');
    }
}