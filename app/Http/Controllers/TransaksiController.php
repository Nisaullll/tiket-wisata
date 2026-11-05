<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input form pemesanan
        $request->validate([
            'jumlah_tiket' => 'required|integer|min:1',
            'tanggal_kunjungan' => 'required|date',
        ]);

        // Simpan data transaksi ke database sesuai kolom yang tersedia di tabel transaksis
        $transaksi = new Transaksi();
        $transaksi->kode_transaksi = 'TRX-' . strtoupper(uniqid());
        $transaksi->user_id = Auth::id();
        $transaksi->tiket_id = $request->tiket_id ?? 1;
        $transaksi->jumlah_tiket = $request->jumlah_tiket;
        $transaksi->total_harga = $request->jumlah_tiket * 50000;
        $transaksi->tanggal_kunjungan = $request->tanggal_kunjungan;
        $transaksi->status = 'Pending';
        $transaksi->save();

        // Mengarahkan ke rute 'transaksi.show' yang sesuai dengan web.php
        return redirect()->route('transaksi.show', $transaksi->id)
                         ->with('success', 'Tiket berhasil dipesan! Silakan selesaikan pembayaran.');
    }

    public function showTiket($id)
    {
        // Ambil data transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);

        // Tampilkan halaman e-tiket dari folder views/Tiket/show.blade.php
        return view('Tiket.show', compact('transaksi'));
    }
}