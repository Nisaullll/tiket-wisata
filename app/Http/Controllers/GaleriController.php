<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::latest()->get();
        return view('galeri', compact('galeri'));
    }

    public function store(Request $request)
    {
        // Otomatis membuat storage link jika folder public/storage belum terbentuk
        if (!file_exists(public_path('storage'))) {
            app('files')->link(storage_path('app/public'), public_path('storage'));
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Simpan file gambar ke folder public/galeri
        $path = $request->file('gambar')->store('galeri', 'public');

        // Simpan data ke database
        Galeri::create([
            'destinasi_id' => 1, // Diset otomatis ke 1 sesuai form blade
            'judul' => $request->judul,
            'gambar' => $path,
        ]);

        return back()->with('success', 'Foto galeri berhasil diunggah!');
    }

    // ================= TAMBAHAN METHOD UPDATE (UBAH) =================
    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'judul' => $request->judul,
        ];

        // Jika ada file gambar baru yang diunggah saat mengubah data
        if ($request->hasFile('gambar')) {
            // Hapus file gambar lama dari storage jika ada
            if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
                Storage::disk('public')->delete($galeri->gambar);
            }

            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        $galeri->update($data);

        return back()->with('success', 'Foto galeri berhasil diperbarui!');
    }

    // ================= TAMBAHAN METHOD DESTROY (HAPUS) =================
    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        // Hapus file fisik gambar dari folder storage
        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        // Hapus data dari database
        $galeri->delete();

        return back()->with('success', 'Foto galeri berhasil dihapus!');
    }
}