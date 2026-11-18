<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <--- WAJIB ADA AGAR STORAGE TIDAK ERROR
use App\Models\Tenda; // <--- WAJIB ADA AGAR MODEL TERBACA

class TendaController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.laporan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'kuota'      => 'required|integer|min:0', // Validasi input kuota camp
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Nullable jika admin hanya ingin mengubah kuota tanpa ganti foto
        ]);

        // Cek data tenda yang sudah ada berdasarkan nama paket
        $tenda = Tenda::where('nama_paket', $request->nama_paket)->first();
        $path = $tenda ? $tenda->gambar : null;

        // Jika ada file gambar baru yang di-upload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            // Simpan gambar baru
            $path = $request->file('gambar')->store('tenda', 'public');
        }

        // Simpan atau perbarui data ke database
        Tenda::updateOrCreate(
            ['nama_paket' => $request->nama_paket],
            [
                'kuota'  => $request->kuota,
                'gambar' => $path,
            ]
        );

        return back()->with('success', 'Foto dan kuota paket tenda berhasil diperbarui!');
    }

    // Method untuk menghapus data paket tenda dan file gambarnya
    public function destroy($id)
    {
        $tenda = Tenda::findOrFail($id);
        
        // Hapus file gambar dari storage jika ada
        if ($tenda->gambar && Storage::disk('public')->exists($tenda->gambar)) {
            Storage::disk('public')->delete($tenda->gambar);
        }

        $tenda->delete();

        return back()->with('success', 'Data paket tenda berhasil dihapus!');
    }
}