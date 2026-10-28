@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<section class="hero d-flex align-items-center text-white">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Jelajahi Pesona Desa Wisata Paninggaran</h1>
        <p class="lead col-lg-8 mx-auto">Nikmati keindahan alam, budaya lokal, dan pengalaman liburan terbaik dengan sistem layanan digital terpadu.</p>
        <div class="d-flex gap-2 justify-content-center flex-wrap mt-4">
            <a href="{{ route('tentang') }}" class="btn btn-warning btn-lg fw-semibold">Tentang Kami</a>
            <a href="#layanan-crm" class="btn btn-outline-light btn-lg fw-semibold">Layanan & Analitik CRM</a>
        </div>
    </div>
</section>

<!-- ================= TENTANG WISATA (DIPINDAHKAN KE ATAS CRM) ================= -->
<section class="container py-5">
    <div class="row align-items-center g-4">
        <div class="col-lg-6">
            <img src="{{ asset('img/Trianggulasi.jpg') }}" class="img-fluid rounded-4 shadow" alt="Pesona Wisata">
        </div>
        <div class="col-lg-6">
            <h6 class="text-warning fw-bold text-uppercase">Tentang Wisata Kami</h6>
            <h2 class="fw-bold">Keindahan & Pesona Desa Wisata Paninggaran</h2>
            <p class="text-muted">
                <b>Desa Wisata Paninggaran</b> menyajikan pesona alam yang asri, udara pegunungan yang sejuk, serta kehangatan budaya lokal. Didukung dengan sistem pelayanan digital CRM, kami berkomitmen memberikan pengalaman berkunjung yang aman, nyaman, dan tak terlupakan bagi setiap wisatawan.
            </p>
            <a href="{{ route('tentang') }}" class="btn btn-dark">Selengkapnya</a>
        </div>
    </div>
</section>

<!-- ================= IMPLEMENTASI 3 PILAR CRM ================= -->
<section id="layanan-crm" class="bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold text-uppercase mb-2">Sistem CRM Terintegrasi</span>
            <h2 class="fw-bold">Layanan Digital & Analitik Desa Wisata</h2>
            <p class="text-muted col-lg-7 mx-auto">Penerapan Operational, Collaborative, dan Analytical CRM untuk meningkatkan kepuasan pengunjung Desa Wisata Paninggaran.</p>
        </div>

        <div class="row g-4 mb-5">
            <!-- 1. Operational CRM: Form Pemesanan Tiket -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-warning text-dark rounded-3 p-3 me-3 fw-bold fs-4">🎟️</div>
                        <div>
                            <h4 class="fw-bold mb-0">Pemesanan Tiket Online</h4>
                            <small class="text-warning fw-bold">OPERATIONAL CRM</small>
                        </div>
                    </div>
                    <p class="text-muted small">Pesan tiket masuk Desa Wisata Paninggaran secara otomatis dan dapatkan E-Ticket QR Code.</p>
                    
                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="destinasi_id" value="1">
                        
                        <!-- Input Nama Pembeli -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Pemesan Tiket</label>
                            <input type="text" name="nama_pembeli" class="form-control" 
                                value="{{ Auth::check() ? Auth::user()->name : '' }}" 
                                placeholder="Masukkan nama lengkap pemesan..." required>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label fw-semibold">Jumlah Tiket</label>
                                <input type="number" name="jumlah_tiket" class="form-control" min="1" value="1" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-semibold">Tanggal Kunjungan</label>
                                <input type="date" name="tanggal_kunjungan" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning w-100 fw-semibold text-dark shadow-sm">Pesan Tiket & Tampilkan QR Code</button>
                    </form>
                </div>
            </div>

            <!-- 2. Collaborative CRM: Form Ulasan & Feedback -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary text-white rounded-3 p-3 me-3 fw-bold fs-4">⭐</div>
                        <div>
                            <h4 class="fw-bold mb-0">Ulasan & Rating Pengunjung</h4>
                            <small class="text-primary fw-bold">COLLABORATIVE CRM</small>
                        </div>
                    </div>
                    <p class="text-muted small">Ruang interaksi wisatawan untuk memberikan penilaian dan feedback layanan.</p>

                    <form action="{{ route('ulasan.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="destinasi_id" value="1">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Penilaian / Rating</label>
                            <select name="rating" class="form-select" required>
                                <option value="5">⭐⭐⭐⭐⭐ - Sangat Memuaskan (5.0)</option>
                                <option value="4">⭐⭐⭐⭐ - Memuaskan (4.0)</option>
                                <option value="3">⭐⭐⭐ - Cukup (3.0)</option>
                                <option value="2">⭐⭐ - Kurang (2.0)</option>
                                <option value="1">⭐ - Buruk (1.0)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Komentar & Saran</label>
                            <textarea name="komentar" class="form-control" rows="3" placeholder="Bagikan kesan dan saran Anda..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-semibold shadow-sm">Kirim Ulasan</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- 3. Analytical CRM: Dashboard Statistik & Laporan Kunjungan -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow rounded-4 p-4 p-md-5 bg-white">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4 border-bottom pb-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-success text-white rounded-3 p-3 me-3 fw-bold fs-4">📊</div>
                            <div>
                                <h4 class="fw-bold mb-0">Dashboard Analisis & Laporan Wisata</h4>
                                <small class="text-success fw-bold">ANALYTICAL CRM — REKAPITULASI DATA PENGELOLA</small>
                            </div>
                        </div>
                        <span class="badge bg-success-subtle text-success border border-success px-3 py-2 rounded-pill">Status: Data Realtime</span>
                    </div>

                    <p class="text-muted mb-4">Pengolahan data transaksi dan evaluasi ulasan untuk membantu pengelola Desa Wisata Paninggaran dalam pengambilan keputusan strategis.</p>

                    <div class="row text-center g-3 mb-4">
                        <div class="col-md-4">
                            <div class="p-4 bg-light rounded-4 border">
                                <span class="text-muted small fw-bold text-uppercase d-block mb-1">Total Tiket Terjual</span>
                                <h2 class="fw-bold text-success mb-0">124 <small class="fs-6 text-muted">Tiket</small></h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 bg-light rounded-4 border">
                                <span class="text-muted small fw-bold text-uppercase d-block mb-1">Total Ulasan Wisatawan</span>
                                <h2 class="fw-bold text-primary mb-0">88 <small class="fs-6 text-muted">Ulasan</small></h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 bg-light rounded-4 border">
                                <span class="text-muted small fw-bold text-uppercase d-block mb-1">Indeks Kepuasan</span>
                                <h2 class="fw-bold text-warning mb-0">4.8 / 5.0 <small class="fs-6 text-muted">⭐</small></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- ================= END 3 PILAR CRM ================= -->

<section class="bg-body-tertiary py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
            <h2 class="fw-bold mb-0">Galeri Foto</h2>
            <a href="{{ route('galeri') }}" class="btn btn-outline-dark">Lihat Semua Foto</a>
        </div>
        <div class="row g-3">
            @foreach ($galeri as $foto)
                <div class="col-6 col-md-4">
                    <div class="d-block rounded-3 galeri-item shadow-sm overflow-hidden">
                        <img src="{{ $foto->gambar_url ?? asset('img/Candi prambanan.jpg') }}" class="w-100 galeri-thumb" alt="{{ $foto->judul ?? 'Galeri Wisata' }}" loading="lazy" style="height: 220px; object-fit: cover;">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="container py-5 text-center">
    <h2 class="fw-bold">Punya Pertanyaan?</h2>
    <p class="text-muted">Tim pengelola siap membantu merencanakan kunjungan Anda ke Desa Wisata Paninggaran.</p>
    <a href="{{ route('kontak') }}" class="btn btn-warning btn-lg fw-semibold">Hubungi Kami</a>
</section>
@endsection