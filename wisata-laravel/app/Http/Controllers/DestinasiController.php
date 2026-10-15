<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DestinasiController extends Controller
{
    public function index(Request $request)
    {
        $destinasi = Destinasi::with('kategori')
            ->when($request->filled('kategori'), fn ($q) => $q->whereHas(
                'kategori', fn ($k) => $k->where('slug', $request->kategori)
            ))
            ->when($request->filled('cari'), fn ($q) => $q->where(function ($w) use ($request) {
                $w->where('nama', 'like', "%{$request->cari}%")
                    ->orWhere('lokasi', 'like', "%{$request->cari}%");
            }))
            ->orderBy('nama')
            ->paginate(6)
            ->withQueryString();

        return view('destinasi.index', [
            'destinasi' => $destinasi,
            'kategori' => Kategori::orderBy('nama')->get(),
        ]);
    }

    public function show(Destinasi $destinasi)
    {
        $destinasi->load('kategori', 'galeri');

        $lainnya = Destinasi::where('id', '!=', $destinasi->id)
            ->where('kategori_id', $destinasi->kategori_id)
            ->take(3)
            ->get();

        if ($lainnya->isEmpty()) {
            $lainnya = Destinasi::where('id', '!=', $destinasi->id)->inRandomOrder()->take(3)->get();
        }

        return view('destinasi.show', compact('destinasi', 'lainnya'));
    }
}
