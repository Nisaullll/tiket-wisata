<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinasi;
use App\Models\Galeri;

class BerandaController extends Controller
{
    public function index()
    {
        return view('beranda', [
            'unggulan' => Destinasi::where('unggulan', true)->latest('id')->take(4)->get(),
            'kategori' => [], // Dibuat kosong sementara agar beranda langsung terbuka normal
            'galeri' => Galeri::inRandomOrder()->take(6)->get(),
        ]);
    }

    public function tentang()
    {
        return view('tentang');
    }
}