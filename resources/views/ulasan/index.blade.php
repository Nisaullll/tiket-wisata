{{-- Simpan sebagai: resources/views/ulasan/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Rating & Ulasan Pengunjung')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        {{-- Dilebarkan dari col-md-8 supaya dua kartu muat berdampingan --}}
        <div class="col-xl-10">

            <!-- Judul Halaman -->
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark">⭐ Rating & Ulasan Pengunjung</h2>
                <p class="text-muted">Bagikan pengalaman atau lihat penilaian wisatawan terhadap layanan Desa Wisata Trianggulasi.</p>
            </div>

            <!-- Pesan Sukses -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- ================= BARIS 1: RATING (kiri) + DASHBOARD (kanan) ================= -->
            <div class="row g-4 mb-5">

                <!-- 1. Collaborative CRM: Rekapan Rating & Ulasan -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-secondary text-white rounded-3 p-3 me-3 fw-bold fs-4"><i class="bi bi-star-fill"></i></div>
                            <div>
                                <h4 class="fw-bold mb-0">Ulasan & Rating Pengunjung</h4>
                            </div>
                        </div>
                        <p class="text-muted small">Ringkasan penilaian kepuasan wisatawan yang telah memberikan ulasan terhadap layanan desa wisata.</p>

                        <div class="text-center p-3 bg-light rounded-4 border mt-auto">
                            <span class="text-muted small fw-bold text-uppercase d-block mb-1">Rata-Rata Penilaian</span>
                            <h1 class="fw-bold text-warning display-4 mb-0">{{ $rataRating ?? '5.0' }} <small class="fs-5 text-muted">/ 5.0</small></h1>
                            <div class="text-warning my-1 fs-5">★★★★★</div>
                            <span class="text-muted small">Berdasarkan rekapan ulasan pengunjung terverifikasi</span>
                        </div>
                    </div>
                </div>

                <!-- 2. Analytical CRM: Dashboard Statistik & Laporan Kunjungan (Realtime Database) -->
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3 border-bottom pb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-secondary text-white rounded-3 p-3 me-3 fw-bold fs-4"><i class="bi bi-bar-chart-fill"></i></div>
                                <div>
                                    <h4 class="fw-bold mb-0">Dashboard Analisis & Laporan Wisata</h4>
                                </div>
                            </div>
                            <span class="badge bg-secondary text-white px-3 py-2 rounded-pill">Status: Data Realtime</span>
                        </div>

                        <p class="text-muted small mb-3">Pengolahan data transaksi dan evaluasi ulasan untuk membantu pengelola Desa Wisata Paninggaran dalam pengambilan keputusan strategis.</p>

                        <div class="row text-center g-2 mt-auto">
                            <div class="col-4">
                                <div class="p-2 bg-light rounded-4 border h-100">
                                    <span class="text-muted fw-bold text-uppercase d-block mb-1" style="font-size: 11px;">Total Tiket Terjual</span>
                                    <h3 class="fw-bold text-secondary mb-0">{{ $totalTiket ?? 0 }}</h3>
                                    <small class="text-muted">Tiket</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 bg-light rounded-4 border h-100">
                                    <span class="text-muted fw-bold text-uppercase d-block mb-1" style="font-size: 11px;">Total Ulasan</span>
                                    <h3 class="fw-bold text-secondary mb-0">{{ $totalUlasan ?? 0 }}</h3>
                                    <small class="text-muted">Ulasan</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 bg-light rounded-4 border h-100">
                                    <span class="text-muted fw-bold text-uppercase d-block mb-1" style="font-size: 11px;">Indeks Kepuasan</span>
                                    <h3 class="fw-bold text-secondary mb-0">{{ $rataRating ?? '5.0' }}</h3>
                                    <small class="text-muted">⭐</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KARTU FORM ISI ULASAN -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-5 bg-white">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-warning text-dark rounded-3 d-flex align-items-center justify-content-center fw-bold fs-4" style="width: 50px; height: 50px;">
                        ★
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">Beri Ulasan & Rating Pengunjung</h5>
                        <small class="text-muted">Bagikan ulasan Anda setelah selesai berkunjung</small>
                    </div>
                </div>

                <form action="{{ route('ulasan.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label fw-semibold small">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::check() ? Auth::user()->name : '' }}" required placeholder="Nama Anda...">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="rating" class="form-label fw-semibold small">Rating Penilaian</label>
                            <select class="form-select" id="rating" name="rating" required>
                                <option value="5">★★★★★ (5.0 - Sangat Memuaskan)</option>
                                <option value="4">★★★★☆ (4.0 - Memuaskan)</option>
                                <option value="3">★★★☆☆ (3.0 - Cukup)</option>
                                <option value="2">★★☆☆☆ (2.0 - Kurang)</option>
                                <option value="1">★☆☆☆☆ (1.0 - Buruk)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pesan" class="form-label fw-semibold small">Ulasan / Kesan Kunjungan</label>
                        <textarea class="form-control" id="pesan" name="pesan" rows="3" required placeholder="Tuliskan ulasan Anda mengenai fasilitas, pemandangan, dan pelayanan di Desa Wisata Trianggulasi..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 fw-semibold py-2">
                        <i class="bi bi-send-fill me-2"></i> Kirim Ulasan & Rating
                    </button>
                </form>
            </div>

            <!-- DAFTAR ULASAN YANG MASUK: 2 KOLOM BERDAMPINGAN -->
            <h4 class="fw-bold mb-4 text-dark">💬 Penilaian & Komentar Terbaru</h4>

            <div class="row g-3">
                @forelse($ulasanList as $ulasan)
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="fw-bold mb-0 text-primary">
                                    {{ $ulasan->name ?? ($ulasan->user->name ?? 'Pengunjung') }}
                                </h6>
                                <span class="text-warning small fw-bold">
                                    @for($i = 1; $i <= ($ulasan->rating ?? 5); $i++) ★ @endfor
                                </span>
                            </div>
                            <p class="text-muted small mb-1">{{ $ulasan->pesan ?? ($ulasan->komentar ?? '-') }}</p>
                            <small class="text-muted" style="font-size: 11px;">{{ $ulasan->created_at ? $ulasan->created_at->diffForHumans() : 'Baru saja' }}</small>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-4 text-muted bg-light rounded-3">
                            <p class="mb-0">Belum ada ulasan yang dikirimkan. Jadilah yang pertama memberikan ulasan!</p>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</div>
@endsection