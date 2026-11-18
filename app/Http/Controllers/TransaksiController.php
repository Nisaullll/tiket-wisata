<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Tiket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input form pemesanan
        $request->validate([
            'jumlah_tiket' => 'required|integer|min:1',
            'tanggal_kunjungan' => 'required|date',
        ]);

        // Cek atau buat data tiket default jika tabel tikets kosong agar foreign key tidak error
        $tiket = Tiket::first();
        if (!$tiket) {
            $tiket = Tiket::create([
                'nama_tiket' => 'Tiket Masuk Reguler',
                'harga' => 50000,
            ]);
        }

        $tiketId = $request->tiket_id ?? $tiket->id;

        // Simpan data transaksi ke database
        $transaksi = new Transaksi();
        $transaksi->kode_transaksi = 'TRX-' . strtoupper(uniqid());
        $transaksi->user_id = Auth::id();
        $transaksi->tiket_id = $tiketId;
        $transaksi->jumlah_tiket = $request->jumlah_tiket;
        $transaksi->total_harga = $request->jumlah_tiket * 50000;
        $transaksi->tanggal_kunjungan = $request->tanggal_kunjungan;
        $transaksi->status = 'Pending';
        $transaksi->save();

        // Mengarahkan ke rute 'transaksi.show'
        return redirect()->route('transaksi.show', $transaksi->id)
                         ->with('success', 'Tiket berhasil dipesan! Silakan selesaikan pembayaran.');
    }

    public function showTiket($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('Tiket.show', compact('transaksi'));
    }

    // ================= FUNGSI UPLOAD BUKTI TRANSFER (BARU) =================
    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $transaksi = Transaksi::findOrFail($id);

        if ($request->hasFile('bukti_transfer')) {
            // Simpan file ke storage/app/public/bukti-transfer
            $path = $request->file('bukti_transfer')->store('bukti-transfer', 'public');
            
            // Update data transaksi
            $transaksi->update([
                'bukti_transfer' => $path,
                'status' => 'Menunggu Verifikasi'
            ]);
        }

        return back()->with('success', 'Bukti transfer berhasil diunggah! Mohon tunggu verifikasi dari admin.');
    }
}