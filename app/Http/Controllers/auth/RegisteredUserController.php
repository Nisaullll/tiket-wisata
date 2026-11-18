<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan halaman register.
     */
    public function create()
    {
        return view('auth.register'); // Sesuaikan dengan path view register Anda jika berbeda
    }

    /**
     * Menangani proses pendaftaran user/pengunjung baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        // Membuat user baru dengan enkripsi password Bcrypt otomatis
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'usertype' => 'visitor', // Diset sebagai pengunjung biasa
            'password' => Hash::make($request->password), // Enkripsi aman standar Laravel
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('beranda', absolute: false))->with('success', 'Registrasi berhasil, selamat datang!');
    }
}