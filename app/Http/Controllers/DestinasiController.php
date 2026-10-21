<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinasi;
use App\Models\Transaksi;
use App\Models\Ulasan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DestinasiController extends Controller
{
    // 1. Simpan Pemesanan Tiket (Operational CRM)
    public function storeTiket(Request $request)
    {
        $request->validate([
            'jumlah_tiket' => 'required|integer|min:1',
            'tanggal_kunjungan' => 'required|date',
        ]);

        $hargaSatuan = 15000; // Harga Tiket Masuk Desa Wisata Paninggaran
        $totalHarga = $hargaSatuan * $request->jumlah_tiket;

        $transaksi = Transaksi::create([
            'kode_transaksi' => 'TKT-' . strtoupper(Str::random(8)),
            'user_id' => Auth::id() ?? 1, // Jika belum login terhubung ke ID user default
            'tiket_id' => $request->tiket_id ?? 1, // Pastikan merujuk ke tiket_id yang valid
            'jumlah_tiket' => $request->jumlah_tiket,
            'total_harga' => $totalHarga,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'status' => 'paid'
        ]);

        // Langsung pindah ke halaman E-Ticket QR Code
        return redirect()->route('transaksi.show', $transaksi->id)->with('success', 'Tiket Berhasil Dipesan!');
    }

    // 2. Tampilkan Detail E-Ticket & QR Code
    public function showTiket($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('tiket.show', compact('transaksi'));
    }

    // 3. Simpan Ulasan / Feedback Wisatawan (Collaborative CRM)
    public function storeUlasan(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string',
        ]);

        Ulasan::create([
            'user_id' => Auth::id() ?? 1,
            'destinasi_id' => $request->destinasi_id ?? 1,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return back()->with('success', 'Ulasan Anda berhasil dikirim!');
    }
}