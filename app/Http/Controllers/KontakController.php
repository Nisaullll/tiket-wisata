<?php

namespace App\Http\Controllers;

use App\Models\Ulasan; // Sesuaikan dengan nama model ulasan Anda di database
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        // Mengambil daftar ulasan terbaru untuk ditampilkan di bawah form kontak
        $ulasanList = Ulasan::latest()->take(6)->get();

        return view('kontak', compact('ulasanList'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'komentar' => ['required', 'string', 'max:2000'],
        ], [], [
            'nama' => 'nama lengkap',
            'rating' => 'rating penilaian',
            'komentar' => 'ulasan kunjungan',
        ]);

        // Simpan data ke tabel ulasan di database
        Ulasan::create($data);

        return redirect()->route('kontak')
            ->with('sukses', 'Terima kasih, ' . $data['nama'] . '! Ulasan dan rating Anda berhasil dikirim.');
    }
}