<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Ditambahkan untuk mendeteksi user yang sedang login

class KontakController extends Controller
{
    public function index()
    {
        // Mengambil daftar ulasan terbaru beserta relasi user-nya untuk ditampilkan di bawah form kontak
        $ulasanList = Ulasan::with('user')->latest()->take(6)->get();

        return view('kontak', compact('ulasanList'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'komentar' => ['required', 'string', 'max:2000'],
        ], [], [
            'nama' => 'nama lengkap',
            'rating' => 'rating penilaian',
            'komentar' => 'ulasan kunjungan',
        ]);

        // Simpan data ke tabel ulasan dengan menyertakan destinasi_id dan user_id
        Ulasan::create([
            'destinasi_id' => 1, // Ditambahkan agar sesuai dengan struktur database
            'user_id' => Auth::check() ? Auth::id() : null, // Menyimpan ID user jika login, atau null jika tamu
            'nama' => Auth::check() ? Auth::user()->name : $validatedData['nama'], // Otomatis pakai nama akun jika login, atau inputan form
            'rating' => $validatedData['rating'],
            'komentar' => $validatedData['komentar'],
        ]);

        return redirect()->route('kontak')
            ->with('sukses', 'Terima kasih, ' . (Auth::check() ? Auth::user()->name : $validatedData['nama']) . '! Ulasan dan rating Anda berhasil dikirim.');
    }
}