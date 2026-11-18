<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fasilitas;
use Illuminate\Support\Facades\Storage;
use App\Models\Transaksi;
use App\Models\Ulasan;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksiList = Transaksi::with('user')->latest()->get();
        $ulasanListAdmin = Ulasan::latest()->get();

        return view('admin.laporan', compact('transaksiList', 'ulasanListAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Otomatis membuat link storage jika belum ada
        if (!file_exists(public_path('storage'))) {
            app('files')->link(storage_path('app/public'), public_path('storage'));
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Simpan file ke folder storage/app/public/fasilitas
        $path = $request->file('gambar')->store('fasilitas', 'public');

        // Simpan atau update data fasilitas ke database berdasarkan judul/nama fasilitas
        \App\Models\Fasilitas::updateOrCreate(
            ['judul' => $request->judul],
            ['gambar' => $path]
        );

        return back()->with('success', 'Foto fasilitas berhasil diperbarui!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}