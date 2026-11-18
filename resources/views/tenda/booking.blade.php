@extends('layouts.app')

@section('title', 'Form Pemesanan & Sewa Tenda')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="bg-success p-4 text-center text-white">
                    <h4 class="fw-bold text-uppercase mb-1">Form Pemesanan & Sewa Tenda</h4>
                    <small class="text-light"></small>
                </div>

                <div class="card-body p-4">
                    <p class="text-muted small mb-4">
                        Lengkapi data di bawah ini untuk mengonfirmasi pemesanan tiket masuk atau perlengkapan camping di Desa Wisata Paninggaran.
                    </p>

                    <!-- Informasi Akun Terverifikasi -->
                    @auth
                    <div class="card bg-light border-0 p-3 mb-3 rounded-3 shadow-sm">
                        <div>
                            <small class="text-muted d-block">Akun Penyewa Terverifikasi:</small>
                            <span class="fw-bold text-dark">{{ Auth::user()->name }}</span> 
                            <small class="text-muted">({{ Auth::user()->email }})</small>
                        </div>
                    </div>
                    @endauth

                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf

                        <!-- PILIHAN JENIS PEMESANAN -->
                        <div class="mb-3">
                            <label for="jenis_pesanan" class="form-label fw-semibold">Jenis Pemesanan</label>
                            <select class="form-select" id="jenis_pesanan" name="jenis_pesanan" required onchange="toggleJenisPemesanan()">
                                <option value="camping" selected>🏕️ Camping & Sewa Tenda</option>
                                <option value="tiket_masuk">🎫 Tiket Masuk Wisata Saja</option>
                            </select>
                        </div>

                        <!-- KELOMPOK INPUT KHUSUS TENDA -->
                        <div id="section-tenda">
                            <div class="mb-3">
                                <label for="paket_tenda" class="form-label fw-semibold">Pilih Paket Tenda</label>
                                <select class="form-select" id="paket_tenda" name="paket_tenda">
                                    <option value="Tenda Keluarga (4-5 Orang)">Tenda Keluarga (4-5 Orang) - Rp 85.000 / malam</option>
                                    <option value="Tenda Standar (2-3 Orang)">Tenda Standar (2-3 Orang) - Rp 50.000 / malam</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="jumlah_unit" class="form-label fw-semibold">Jumlah Unit Tenda</label>
                                <input type="number" class="form-control" id="jumlah_unit" name="jumlah_unit" value="1" min="1">
                            </div>
                        </div>

                        <!-- INPUT UMUM -->
                        <div class="mb-3">
                            <label for="tanggal_kunjungan" class="form-label fw-semibold">Tanggal Kunjungan / Menginap</label>
                            <input type="date" class="form-control" id="tanggal_kunjungan" name="tanggal_kunjungan" required>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_tiket" class="form-label fw-semibold">Jumlah Orang / Tiket Masuk</label>
                            <input type="number" class="form-control" id="jumlah_tiket" name="jumlah_tiket" value="1" min="1" required>
                        </div>

                        <div class="mb-4">
                            <label for="metode_pembayaran" class="form-label fw-semibold">Metode Pembayaran</label>
                            <select class="form-select" id="metode_pembayaran" name="metode_pembayaran" required>
                                <option value="DANA">DANA (E-Wallet)</option>
                                <option value="QRIS">QRIS / Transfer Bank</option>
                                <option value="COD">Bayar di Tempat (Loket Wisata)</option>
                            </select>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="/" class="btn btn-outline-secondary w-50 fw-semibold">Kembali</a>
                            <button type="submit" class="btn btn-success w-50 fw-semibold">Konfirmasi & Bayar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleJenisPemesanan() {
    const jenis = document.getElementById('jenis_pesanan').value;
    const sectionTenda = document.getElementById('section-tenda');
    const inputTenda = document.getElementById('paket_tenda');
    const inputUnit = document.getElementById('jumlah_unit');

    if (jenis === 'tiket_masuk') {
        sectionTenda.style.display = 'none';
        inputTenda.removeAttribute('required');
        inputUnit.removeAttribute('required');
    } else {
        sectionTenda.style.display = 'block';
        inputTenda.setAttribute('required', 'required');
        inputUnit.setAttribute('required', 'required');
    }
}
</script>
@endsection