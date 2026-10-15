<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Galeri;
use App\Models\Kategori;

class BerandaController extends Controller
{
    public function index()
    {
        return view('beranda', [
            'unggulan' => Destinasi::with('kategori')->where('unggulan', true)->latest('id')->take(4)->get(),
            'kategori' => Kategori::withCount('destinasi')->get(),
            'galeri' => Galeri::with('destinasi')->inRandomOrder()->take(6)->get(),
            'statistik' => [
                'destinasi' => Destinasi::count(),
                'kategori' => Kategori::count(),
                'foto' => Galeri::count(),
            ],
        ]);
    }

    public function tentang()
    {
        return view('tentang');
    }
}
