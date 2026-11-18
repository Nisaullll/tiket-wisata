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

            <!-- Pesan Sukses / Notifikasi -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Kartu Utama E-Ticket -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4">
                <div class="bg-warning p-4 text-center text-dark">
                    <h4 class="fw-bold text-uppercase mb-1">E-Ticket Desa Wisata Trianggulasi</h4>
                    <small class="fw-semibold">Bukti Pemesanan Resmi (Operational CRM)</small>
                </div>

                <div class="card-body p-4 text-center">
                    {{-- Status dibuat dinamis berdasarkan data database --}}
                    @if(strtolower($transaksi->status) == 'lunas' || strtolower($transaksi->status) == 'verified')
                        <div class="alert alert-success fw-bold mb-4">
                            STATUS: {{ strtoupper($transaksi->status) }}
                        </div>
                    @elseif(strtolower($transaksi->status) == 'menunggu verifikasi' || $transaksi->bukti_transfer)
                        <div class="alert alert-info fw-bold mb-4">
                            STATUS: MENUNGGU VERIFIKASI ADMIN (BUKTI TERUNGGAH)
                        </div>
                    @else
                        <div class="alert alert-warning fw-bold mb-4">
                            STATUS: PENDING (Menunggu Pembayaran)
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

                    {{-- Tombol Cetak Terbuka jika sudah Lunas, Verified, atau sudah Upload Bukti Transfer --}}
                    @if(in_array(strtolower($transaksi->status), ['lunas', 'verified', 'menunggu verifikasi']) || $transaksi->bukti_transfer)
                        <button onclick="window.print()" class="btn btn-dark w-100 fw-semibold mb-2">
                            🖨️ Cetak / Simpan E-Ticket
                        </button>
                    @else
                        <button type="button" class="btn btn-secondary w-100 fw-semibold mb-2 opacity-50" disabled title="Selesaikan pembayaran dan upload bukti transfer untuk mencetak tiket">
                            🔒 Cetak / Simpan E-Ticket (Menunggu Pembayaran)
                        </button>
                    @endif

                    <a href="/" class="btn btn-outline-secondary w-100 fw-semibold">Kembali ke Beranda</a>
                </div>
            </div>

            <!-- KARTU FORM UPLOAD BUKTI TRANSFER -->
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-dark text-white rounded-3 d-flex align-items-center justify-content-center fw-bold fs-4" style="width: 45px; height: 45px;">
                        <i class="bi bi-cloud-arrow-up-fill"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Konfirmasi Pembayaran</h5>
                        <small class="text-muted">Upload bukti transfer untuk verifikasi tiket</small>
                    </div>
                </div>

                @if($transaksi->bukti_transfer)
                    <div class="alert alert-success small text-center mb-3">
                        <i class="bi bi-check-circle-fill me-1"></i> Bukti transfer sudah diunggah.
                        <div class="mt-2">
                            <a href="{{ asset('storage/' . $transaksi->bukti_transfer) }}" target="_blank" class="btn btn-sm btn-outline-success fw-semibold">
                                🔍 Lihat Bukti Transfer yang Diunggah
                            </a>
                        </div>
                    </div>
                @endif

                <form action="{{ route('transaksi.upload', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="bukti_transfer" class="form-label fw-semibold small">Pilih File Foto Bukti Transfer (JPG, PNG)</label>
                        <input class="form-control" type="file" id="bukti_transfer" name="bukti_transfer" required>
                        @error('bukti_transfer')
                            <small class="text-danger mt-1 d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-warning w-100 fw-semibold py-2 text-dark">
                        <i class="bi bi-upload me-2"></i> Unggah Bukti Transfer Sekarang
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection