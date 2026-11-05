@extends('layouts.app')

@section('title', 'E-Ticket Wisata')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <!-- Kotak Informasi Akun Pemesan & Tombol Ganti Akun -->
            @auth
            <div class="card bg-light border-0 p-3 mb-3 rounded-3 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted d-block">Akun Pemesan Terverifikasi:</small>
                        <span class="fw-bold text-dark">{{ Auth::user()->name }}</span> 
                        <small class="text-muted">({{ Auth::user()->email }})</small>
                    </div>
                    <div>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger fw-semibold" onclick="return confirm('Keluar dari akun ini?')">
                                🔄 Ganti Akun
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endauth

            <!-- Kartu Utama E-Ticket -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="bg-warning p-4 text-center text-dark">
                    <h4 class="fw-bold text-uppercase mb-1">E-Ticket Desa Wisata Trianggulasi</h4>
                    <small class="fw-semibold">Bukti Pemesanan Resmi (Operational CRM)</small>
                </div>

                <div class="card-body p-4 text-center">
                    {{-- Status dibuat dinamis berdasarkan data database --}}
                    @if($transaksi->status == 'Lunas' || $transaksi->status == 'Verified')
                        <div class="alert alert-success fw-bold mb-4">
                            STATUS: {{ strtoupper($transaksi->status) }}
                        </div>
                    @else
                        <div class="alert alert-warning fw-bold mb-4">
                            STATUS: {{ strtoupper($transaksi->status) }} (Menunggu Pembayaran)
                        </div>
                    @endif

                    <!-- Gambar QR Code Otomatis Tergenerate -->
                    <div class="my-3 p-3 bg-light rounded-3 border d-inline-block shadow-sm">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ $transaksi->kode_transaksi }}" alt="QR Code Tiket" class="img-fluid">
                    </div>
                    
                    <h5 class="fw-bold text-primary mb-4">{{ $transaksi->kode_transaksi }}</h5>

                    <table class="table table-borderless text-start small mb-4">
                        <tr>
                            <td class="text-muted">Tanggal Kunjungan</td>
                            <td class="fw-bold text-end">{{ date('d M Y', strtotime($transaksi->tanggal_kunjungan)) }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Jumlah Tiket</td>
                            <td class="fw-bold text-end">{{ $transaksi->jumlah_tiket }} Orang</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Total Pembayaran</td>
                            <td class="fw-bold text-end text-success fs-6">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Metode Pembayaran</td>
                            <td class="fw-bold text-end text-uppercase">
                                <span class="badge bg-secondary">{{ $transaksi->metode_pembayaran ?? 'QRIS / Transfer' }}</span>
                            </td>
                        </tr>
                    </table>

                    <button onclick="window.print()" class="btn btn-dark w-100 fw-semibold mb-2">🖨️ Cetak / Simpan E-Ticket</button>
                    <a href="/" class="btn btn-outline-secondary w-100 fw-semibold">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection