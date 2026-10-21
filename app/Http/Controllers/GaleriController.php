<?php

namespace App\Http\Controllers;

use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index()
    {
        return view('galeri', [
            'galeri' => Galeri::with('destinasi.kategori')->latest('id')->get(),
        ]);
    }
}
