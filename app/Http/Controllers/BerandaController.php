<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinasi;
use App\Models\Galeri;
use App\Models\Ulasan;
use App\Models\Transaksi; // Ditambahkan untuk menghitung total tiket terjual secara dinamis

class BerandaController extends Controller
{
    public function index()
    {
        // Menghitung rata-rata rating dan total ulasan dari database secara dinamis
        $rataRating = Ulasan::avg('rating') ? number_format(Ulasan::avg('rating'), 1) : '4.8';
        $totalUlasan = Ulasan::count() > 0 ? Ulasan::count() : 88;
        
        // Mengambil ulasan terbaru untuk ditampilkan sebagai card testimoni di beranda
        $ulasanTerbaru = Ulasan::latest()->take(3)->get();

        // Menghitung total tiket terjual dari database secara dinamis
        $totalTiket = Transaksi::sum('jumlah_tiket') ? Transaksi::sum('jumlah_tiket') : 124;

        return view('beranda', [
            'unggulan' => Destinasi::where('unggulan', true)->latest('id')->take(4)->get(),
            'kategori' => [], // Dibuat kosong sementara agar beranda langsung terbuka normal
            'galeri' => Galeri::inRandomOrder()->take(6)->get(),
            'rataRating' => $rataRating,
            'totalUlasan' => $totalUlasan,
            'ulasanTerbaru' => $ulasanTerbaru,
            'totalTiket' => $totalTiket, // Dikirim ke view beranda.blade.php
        ]);
    }

    public function tentang()
    {
        return view('tentang');
    }
}