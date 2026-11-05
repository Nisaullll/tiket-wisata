@extends('layouts.app')

@section('title', 'Kontak & Ulasan Pengunjung')

@section('content')
@include('partials.page-header', ['judul' => 'Kontak & Ulasan Pengunjung', 'subjudul' => 'Hubungi kami atau bagikan pengalaman kunjungan Anda di Desa Wisata'])

<section class="container py-5">
    <div class="row g-4">
        <!-- Kolom Kiri: Informasi Kontak -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Informasi Kontak</h5>
                    <p><i class="bi bi-whatsapp text-success me-2 fs-5"></i> <b>WhatsApp CS</b><br><span class="text-muted ms-4">0812-3456-7890</span></p>
                    <p><i class="bi bi-envelope text-primary me-2 fs-5"></i> <b>Email</b><br><span class="text-muted ms-4">support@Trianggulasi.com</span></p>
                    <p><i class="bi bi-clock text-warning me-2 fs-5"></i> <b>Jam Operasional</b><br><span class="text-muted ms-4">Senin - Minggu, 08.00 - 17.00 WIB</span></p>
                    <p class="mb-0"><i class="bi bi-geo-alt text-danger me-2 fs-5"></i> <b>Alamat Kantor</b><br><span class="text-muted ms-4">Kecamatan Paninggaran, Kabupaten Pekalongan, Jawa Tengah</span></p>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Form Ulasan & Rating (Menggantikan Form Kirim Pesan) -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-warning text-dark rounded-3 px-3 py-2 me-3 fw-bold fs-4">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">Beri Ulasan & Rating Pengunjung</h5>
                            <small class="text-muted">Bagikan ulasan Anda setelah selesai berkunjung</small>
                        </div>
                    </div>

                    @if (session('sukses') || session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('sukses') ?? session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('ulasan.store') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" value="{{ old('nama', Auth::user()->name ?? '') }}"
                                       class="form-control @error('nama') is-invalid @enderror" placeholder="Contoh: Nisaul Fitriana" required>
                                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="rating" class="form-label fw-semibold">Rating Penilaian</label>
                                <select id="rating" name="rating" class="form-select @error('rating') is-invalid @enderror" required>
                                    <option value="5" selected>★★★★★ (5.0 - Sangat Memuaskan)</option>
                                    <option value="4">★★★★☆ (4.0 - Memuaskan)</option>
                                    <option value="3">★★★☆☆ (3.0 - Cukup)</option>
                                    <option value="2">★★☆☆☆ (2.0 - Kurang)</option>
                                    <option value="1">★☆☆☆☆ (1.0 - Buruk)</option>
                                </select>
                                @error('rating') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label for="komentar" class="form-label fw-semibold">Ulasan / Kesan Kunjungan</label>
                                <textarea id="komentar" name="komentar" rows="4"
                                          class="form-control @error('komentar') is-invalid @enderror" 
                                          placeholder="Tuliskan ulasan Anda mengenai fasilitas, pemandangan, dan pelayanan di Desa Wisata Trianggulasi..." required>{{ old('komentar') }}</textarea>
                                @error('komentar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-dark fw-semibold px-4 py-2 w-100">
                                    <i class="bi bi-send-fill me-1"></i> Kirim Ulasan & Rating
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= DAFTAR ULASAN PENGUNJUNG TERBARU ================= -->
    <div class="mt-5">
        <h4 class="fw-bold mb-4">Ulasan Pengunjung Terverifikasi</h4>
        <div class="row g-3">
            @isset($ulasanList)
                @forelse($ulasanList as $item)
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 rounded-4 p-3 bg-white">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold text-dark">{{ $item->nama }}</span>
                                <span class="text-warning fw-bold">
                                    @for($i = 0; $i < $item->rating; $i++) ★ @endfor
                                </span>
                            </div>
                            <p class="text-muted small mb-0">"{{ $item->komentar }}"</p>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-4">
                        <p class="mb-0">Belum ada ulasan yang diberikan oleh pengunjung.</p>
                    </div>
                @endforelse
            @else
                <div class="col-12 text-center text-muted py-4">
                    <p class="mb-0">Ulasan yang dikirimkan akan langsung terekap ke dalam data ulasan sistem CRM.</p>
                </div>
            @endisset
        </div>
    </div>
</section>
@endsection