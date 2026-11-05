@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<section class="hero d-flex align-items-center text-white">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Jelajahi Pesona Desa Wisata Paninggaran</h1>
        <p class="lead col-lg-8 mx-auto">Nikmati keindahan alam, budaya lokal, dan pengalaman liburan terbaik dengan sistem layanan digital terpadu.</p>
        <div class="d-flex gap-2 justify-content-center flex-wrap mt-4">
            <a href="{{ route('tentang') }}" class="btn btn-secondary btn-lg fw-semibold">Tentang Kami</a>
            <a href="#layanan-crm" class="btn btn-outline-light btn-lg fw-semibold">Layanan & Analitik CRM</a>
        </div>
    </div>
</section>

<!-- ================= TENTANG WISATA ================= -->
<section class="container py-5">
    <div class="row align-items-center g-4">
        <div class="col-lg-6">
            <img src="{{ asset('img/Trianggulasi.jpg') }}" class="img-fluid rounded-4 shadow" alt="Pesona Wisata">
        </div>
        <div class="col-lg-6">
            <h6 class="text-secondary fw-bold text-uppercase">Tentang Wisata Kami</h6>
            <h2 class="fw-bold">Keindahan & Pesona wisata Trianggulasi </h2>
            <p class="text-muted">
                <b>Wisata Paninggaran</b> menyajikan pesona alam yang asri, udara pegunungan yang sejuk, serta kehangatan budaya lokal. Didukung dengan sistem pelayanan digital CRM, kami berkomitmen memberikan pengalaman berkunjung yang aman, nyaman, dan tak terlupakan bagi setiap wisatawan.
            </p>
            <a href="{{ route('tentang') }}" class="btn btn-dark">Selengkapnya</a>
        </div>
    </div>
</section>

<!-- ================= GALERI FOTO ================= -->
<section class="bg-body-tertiary py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
            <h2 class="fw-bold mb-0">Galeri Foto</h2>
            <a href="{{ route('galeri') }}" class="btn btn-outline-dark">Lihat Semua Foto</a>
        </div>
        <div class="row g-3">
            @forelse ($galeri as $foto)
                <div class="col-6 col-md-4">
                    <div class="card border-0 shadow-sm overflow-hidden h-100">
                        <img src="{{ asset('storage/' . $foto->gambar) }}" class="card-img-top w-100" alt="{{ $foto->judul }}" loading="lazy" style="height: 220px; object-fit: cover;">
                        <div class="card-body py-2">
                            <div class="fw-semibold small text-truncate">{{ $foto->judul }}</div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4 text-muted">
                    <p>Belum ada dokumentasi foto galeri.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ================= IMPLEMENTASI PILAR CRM ================= -->
<section id="layanan-crm" class="bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-secondary text-white px-3 py-2 rounded-pill fw-bold text-uppercase mb-2">Sistem CRM Terintegrasi</span>
            <h2 class="fw-bold">Layanan Digital & Analitik Desa Wisata</h2>
            <p class="text-muted col-lg-7 mx-auto">Penerapan Operational, Collaborative, dan Analytical CRM untuk meningkatkan kepuasan pengunjung Desa Wisata Paninggaran.</p>
        </div>

        <div class="row g-4 mb-5">
            <!-- 1. Operational CRM: Form Pemesanan Tiket (Wajib Login) -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-secondary text-white rounded-3 p-3 me-3 fw-bold fs-4"><i class="bi bi-ticket-perforated"></i></div>
                        <div>
                            <h4 class="fw-bold mb-0">Pemesanan Tiket Online</h4>
                            <small class="text-secondary fw-bold">OPERATIONAL CRM</small>
                        </div>
                    </div>
                    <p class="text-muted small">Pesan tiket masuk Desa Wisata Paninggaran secara otomatis, lakukan pembayaran, dan dapatkan E-Ticket QR Code.</p>
                    
                    @auth
                        <!-- Jika Pengunjung Sudah Login, Tampilkan Form Pemesanan -->
                        <form action="{{ route('transaksi.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="destinasi_id" value="1">
                            
                            <!-- Informasi Akun Pemesan yang Sedang Login -->
                            <div class="mb-3 p-3 bg-light rounded-3 border">
                                <small class="text-muted d-block fw-semibold">Akun Pemesan Terverifikasi:</small>
                                <span class="fw-bold text-dark">{{ Auth::user()->name }}</span> 
                                <span class="text-muted small">({{ Auth::user()->email }})</span>
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

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Metode Pembayaran</label>
                                <select name="metode_pembayaran" class="form-select" required>
                                    <option value="dana" selected>DANA (E-Wallet)</option>
                                    <option value="qris">QRIS (All Payment)</option>
                                    <option value="transfer">Bank Transfer (BCA / BRI / Mandiri)</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-dark w-100 fw-semibold shadow-sm">Lanjutkan Pembayaran & Dapatkan Tiket</button>
                        </form>
                    @else
                        <!-- Jika Belum Login, Arahkan Login Terlebih Dahulu -->
                        <div class="text-center py-5 my-auto">
                            <div class="mb-3 text-secondary">
                                <i class="bi bi-lock-fill fs-1"></i>
                            </div>
                            <h5 class="fw-bold">Silakan Login Terlebih Dahulu</h5>
                            <p class="text-muted small mb-4">Demi keamanan dan pencatatan tiket, Anda diwajibkan masuk ke akun Anda sebelum melakukan pemesanan.</p>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('login') }}" class="btn btn-dark px-4 fw-semibold">Login / Masuk Akun</a>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- 2. Collaborative CRM: Rekapan Rating & Ulasan (Dinamis dari Database) -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-secondary text-white rounded-3 p-3 me-3 fw-bold fs-4"><i class="bi bi-star-fill"></i></div>
                        <div>
                            <h4 class="fw-bold mb-0">Ulasan & Rating Pengunjung</h4>
                            <small class="text-secondary fw-bold">COLLABORATIVE CRM — REKAPAN</small>
                        </div>
                    </div>
                    <p class="text-muted small">Ringkasan penilaian kepuasan wisatawan yang telah memberikan ulasan terhadap layanan desa wisata.</p>

                    <!-- Kotak Rekapan Penilaian Dinamis -->
                    <div class="text-center p-3 bg-light rounded-4 border mb-3">
                        <span class="text-muted small fw-bold text-uppercase d-block mb-1">Rata-Rata Penilaian</span>
                        <h1 class="fw-bold text-warning display-4 mb-0">{{ $rataRating ?? '4.8' }} <small class="fs-5 text-muted">/ 5.0</small></h1>
                        <div class="text-warning my-1 fs-5">
                            ★★★★★
                        </div>
                        <span class="text-muted small">Berdasarkan rekapan {{ $totalUlasan ?? 88 }} ulasan pengunjung terverifikasi</span>
                    </div>

                    <!-- Testimoni / Daftar Ulasan Terbaru Pengunjung -->
                    <div class="mb-2">
                        <span class="fw-bold text-dark small d-block mb-2">Testimoni Pengunjung Terbaru:</span>
                        <div class="vstack gap-2">
                            @isset($ulasanTerbaru)
                                @forelse($ulasanTerbaru as $testi)
                                    <div class="p-2 bg-light rounded-3 border-0 small">
                                        <div class="d-flex justify-content-between">
                                            <strong class="text-dark">{{ $testi->nama }}</strong>
                                            <span class="text-warning">@for($i=0; $i < $testi->rating; $i++)★@endfor</span>
                                        </div>
                                        <p class="text-muted mb-0 text-truncate">"{{ $testi->komentar }}"</p>
                                    </div>
                                @empty
                                    <div class="text-muted small text-center py-2">Belum ada ulasan yang dikirimkan pengunjung.</div>
                                @endforelse
                            @endisset
                        </div>
                    </div>

                    <div class="alert alert-secondary text-center small mt-3 mb-0">
                        <i class="bi bi-info-circle-fill"></i> Ingin memberikan ulasan? Kunjungi menu <a href="{{ route('kontak') }}" class="fw-bold text-dark">Kontak & Ulasan</a>.
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Analytical CRM: Dashboard Statistik & Laporan Kunjungan -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow rounded-4 p-4 p-md-5 bg-white">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4 border-bottom pb-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-secondary text-white rounded-3 p-3 me-3 fw-bold fs-4"><i class="bi bi-bar-chart-fill"></i></div>
                            <div>
                                <h4 class="fw-bold mb-0">Dashboard Analisis & Laporan Wisata</h4>
                                <small class="text-secondary fw-bold">ANALYTICAL CRM — REKAPITULASI DATA PENGELOLA</small>
                            </div>
                        </div>
                        <span class="badge bg-secondary text-white px-3 py-2 rounded-pill">Status: Data Realtime</span>
                    </div>

                    <p class="text-muted mb-4">Pengolahan data transaksi dan evaluasi ulasan untuk membantu pengelola Desa Wisata Paninggaran dalam pengambilan keputusan strategis.</p>

                    <div class="row text-center g-3 mb-4">
                        <div class="col-md-4">
                            <div class="p-4 bg-light rounded-4 border">
                                <span class="text-muted small fw-bold text-uppercase d-block mb-1">Total Tiket Terjual</span>
                                <h2 class="fw-bold text-secondary mb-0">124 <small class="fs-6 text-muted">Tiket</small></h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 bg-light rounded-4 border">
                                <span class="text-muted small fw-bold text-uppercase d-block mb-1">Total Ulasan Wisatawan</span>
                                <h2 class="fw-bold text-secondary mb-0">{{ $totalUlasan ?? 88 }} <small class="fs-6 text-muted">Ulasan</small></h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 bg-light rounded-4 border">
                                <span class="text-muted small fw-bold text-uppercase d-block mb-1">Indeks Kepuasan</span>
                                <h2 class="fw-bold text-secondary mb-0">{{ $rataRating ?? '4.8' }} / 5.0 <small class="fs-6 text-muted">⭐</small></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- ================= END PILAR CRM ================= -->

<section class="container py-5 text-center">
    <h2 class="fw-bold">Punya Pertanyaan?</h2>
    <p class="text-muted">Tim pengelola siap membantu merencanakan kunjungan Anda ke Desa Wisata Paninggaran.</p>
    <a href="{{ route('kontak') }}" class="btn btn-secondary btn-lg fw-semibold">Hubungi Kami</a>
</section>
@endsection