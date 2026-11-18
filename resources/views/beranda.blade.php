@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

<!-- CEK APAKAH USER YANG LOGIN ADALAH ADMIN (BERUBAH OTOMATIS) -->
@auth
    @if(Auth::user()->usertype === 'admin')
        <div class="bg-dark text-white py-4 mb-4 shadow-sm border-bottom border-secondary">
            <div class="container d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <span class="badge bg-danger mb-2 px-3 py-2 fw-bold text-uppercase">
                        <i class="bi bi-shield-lock-fill me-1"></i> Mode Administrator Aktif
                    </span>
                    
                    <p class="text-white-50 small mb-0">pengelola sistem Desa Wisata Paninggaran.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.laporan') }}" class="btn btn-warning fw-semibold px-4 text-dark shadow-sm">
                        <i class="bi bi-speedometer2 me-1"></i> Buka Panel Kontrol Admin
                    </a>
                </div>
            </div>
        </div>
    @endif
@endauth

<section class="hero d-flex align-items-center text-white">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Jelajahi Pesona Desa Wisata Sawangan Paninggaran Trianggulasi</h1>
        <p class="lead col-lg-8 mx-auto">Nikmati keindahan alam, budaya lokal, dan pengalaman liburan terbaik dengan sistem layanan digital terpadu.</p>
        <div class="d-flex gap-2 justify-content-center flex-wrap mt-4">
            <a href="{{ route('tentang') }}" class="btn btn-secondary btn-lg fw-semibold">Tentang Kami</a>
            @auth
                {{-- Tombol Layanan hanya muncul setelah login --}}
                <a href="#layanan-crm" class="btn btn-outline-light btn-lg fw-semibold">Layanan</a>
            @endauth
        </div>
    </div>
</section>

<!-- ================= TENTANG WISATA ================= -->
<section class="container py-5">
    <div class="row align-items-center g-4">
        <div class="col-lg-6">
            <img src="{{ asset('img/Trianggulasi.jpg') }}" class="img-fluid rounded-4 shadow" alt="Pesona Wisata" onerror="this.src='https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80'">
        </div>
        <div class="col-lg-6">
            <h6 class="text-secondary fw-bold text-uppercase">Tentang Wisata Kami</h6>
            <h2 class="fw-bold">Keindahan & Pesona Wisata Trianggulasi</h2>
            <p class="text-muted">
                <b>Wisata Paninggaran</b> menyajikan pesona alam yang asri, udara pegunungan yang sejuk, serta kehangatan budaya lokal. Didukung dengan sistem pelayanan digital CRM, kami berkomitmen memberikan pengalaman berkunjung yang aman, nyaman, dan tak terlupakan bagi setiap wisatawan.
            </p>
            <p class="text-muted">
                Kami bekerja sama dengan pengelola tempat wisata dan masyarakat lokal agar setiap kunjungan memberi manfaat bagi lingkungan dan perekonomian daerah.
            </p>
            <a href="{{ route('tentang') }}" class="btn btn-dark">Selengkapnya</a>
        </div>
    </div>
</section>

<!-- ================= TAMBAHAN KODE: VISI, MISI & KEUNGGULAN ================= -->
<section class="bg-body-tertiary py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm p-4">
                    <h4 class="fw-bold"><i class="bi bi-eye text-warning"></i> Visi</h4>
                    <p class="text-muted mb-0">Menjadi rujukan utama wisatawan untuk mengenal dan menjelajahi kekayaan pariwisata Indonesia secara bertanggung jawab.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm p-4">
                    <h4 class="fw-bold"><i class="bi bi-bullseye text-warning"></i> Misi</h4>
                    <ul class="text-muted mb-0">
                        <li>Menyajikan informasi destinasi yang akurat dan terkini.</li>
                        <li>Mendukung pelestarian alam dan budaya lokal.</li>
                        <li>Memberdayakan masyarakat di sekitar destinasi wisata.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container py-5">
    <h2 class="fw-bold text-center mb-4">Mengapa Memilih Kami?</h2>
    <div class="row g-4 text-center">
        @foreach ([
            ['bi-shield-check', 'Aman & Terpercaya', 'Destinasi yang kami tampilkan telah dikurasi dan diverifikasi.'],
            ['bi-cash-coin', 'Harga Transparan', 'Informasi harga tiket masuk jelas tanpa biaya tersembunyi.'],
            ['bi-people', 'Praktis untuk luar daerah', 'Terhubung langsung dari masyarakat setempat.'],
        ] as [$ikon, $judul, $teks])
            <div class="col-md-4">
                <i class="bi {{ $ikon }} display-5 text-warning"></i>
                <h5 class="fw-bold mt-2">{{ $judul }}</h5>
                <p class="text-muted">{{ $teks }}</p>
            </div>
        @endforeach
    </div>
</section>
<!-- ================= END TAMBAHAN KODE ================= -->

<!-- ================= GALERI FOTO (Dibatasi 3 Foto) ================= -->
<section class="bg-body-tertiary py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
            <h2 class="fw-bold mb-0">Galeri Foto</h2>
            <a href="{{ route('galeri') }}" class="btn btn-outline-dark">Lihat Semua Foto</a>
        </div>
        <div class="row g-3">
            @forelse ($galeri->take(3) as $foto)
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

<!-- ================= 1. SECTION FASILITAS YANG TERSEDIA (DINAMIS DARI ADMIN) ================= -->
@php
    $parkir = \App\Models\Fasilitas::where('judul', 'Area Parkir Luas')->first();
    $spotFoto = \App\Models\Fasilitas::where('judul', 'Spot Foto & Gazebo')->first();
    $toilet = \App\Models\Fasilitas::where('judul', 'Toilet & Mushola')->first();
@endphp

<section class="container py-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Fasilitas yang Tersedia</h2>
        <p class="text-muted">Nikmati berbagai fasilitas pendukung untuk kenyamanan kunjungan Anda di Desa Wisata Paninggaran.</p>
    </div>

    <div class="row g-4">
        <!-- Fasilitas 1: Area Parkir -->
        <div class="col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                <img src="{{ $parkir && $parkir->gambar ? asset('storage/' . $parkir->gambar) : 'https://images.unsplash.com/photo-1506521781263-d8422e82f27a?auto=format&fit=crop&w=600&q=80' }}" class="card-img-top object-fit-cover" style="height: 180px;" alt="Area Parkir">
                <div class="card-body text-center p-4">
                    <div class="mb-3 text-success fs-3">
                        <i class="bi bi-p-square-fill"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Area Parkir Luas</h5>
                    <p class="text-muted small mb-0">Tersedia lahan parkir yang aman dan luas untuk kendaraan roda dua maupun roda empat.</p>
                </div>
            </div>
        </div>

        <!-- Fasilitas 2: Cafe / Spot Foto -->
        <div class="col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                <img src="{{ $spotFoto && $spotFoto->gambar ? asset('storage/' . $spotFoto->gambar) : 'https://images.unsplash.com/photo-1519331379826-f10be5486c6f?auto=format&fit=crop&w=600&q=80' }}" class="card-img-top object-fit-cover" style="height: 180px;" alt="Spot Foto">
                <div class="card-body text-center p-4">
                    <div class="mb-3 text-success fs-3">
                        <i class="bi bi-camera-fill"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Cafe & Spot Foto</h5>
                    <p class="text-muted small mb-0">Berbagai sudut pemandangan alam estetik dan tempat bersantai untuk menikmati suasana pagi.</p>
                </div>
            </div>
        </div>

        <!-- Fasilitas 3: Toilet & Mushola -->
        <div class="col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                <img src="{{ $toilet && $toilet->gambar ? asset('storage/' . $toilet->gambar) : 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=600&q=80' }}" class="card-img-top object-fit-cover" style="height: 180px;" alt="Toilet & Mushola">
                <div class="card-body text-center p-4">
                    <div class="mb-3 text-success fs-3">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Toilet & Mushola</h5>
                    <p class="text-muted small mb-0">Fasilitas umum yang bersih dan terawat untuk kenyamanan beribadah serta kebutuhan pengunjung.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ================= END FASILITAS ================= -->

<!-- ================= 2. SEKSI SEWA TENDA & CAMPING GROUND =================
     HANYA TAMPIL SETELAH PENGUNJUNG LOGIN. Jika belum login, seluruh seksi
     (termasuk tombol Pesan Sekarang) tidak muncul di beranda. -->
@auth
@php
    $tendaStandar = \App\Models\Tenda::where('nama_paket', 'Tenda Standar (2-3 Orang)')->first();
    $tendaKeluarga = \App\Models\Tenda::where('nama_paket', 'Tenda Keluarga (4-5 Orang)')->first();
    $paketLengkap = \App\Models\Tenda::where('nama_paket', 'Paket Lengkap Camping')->first();
@endphp

<section class="container pb-5" id="layanan-crm">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Sewa Tenda & Camping Ground</h2>
        <p class="text-muted">Nikmati pengalaman bermalam di alam terbuka Desa Wisata Paninggaran dengan fasilitas tenda terbaik.</p>
    </div>

    <div class="row g-4">
        <!-- Paket 1: Tenda Standar -->
        <div class="col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden d-flex flex-column">
                <img src="{{ $tendaStandar && $tendaStandar->gambar ? asset('storage/' . $tendaStandar->gambar) : 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&w=600&q=80' }}" class="card-img-top object-fit-cover" style="height: 180px;" alt="Tenda Standar">
                <div class="card-body text-center p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="mb-2 text-success fs-3">
                            <i class="bi bi-tent-fill"></i>
                        </div>
                        <h5 class="fw-bold mb-1">Tenda Standar (2-3 Orang)</h5>
                        <h6 class="text-primary fw-bold mb-2">Rp 45.000 <small class="text-muted fw-normal">/ malam</small></h6>

                        <!-- Informasi Kuota Camp Dinamis -->
                        <div class="mb-2">
                            <span class="badge bg-success px-2 py-1">
                                <i class="bi bi-people-fill me-1"></i> Kuota Tersedia: {{ $tendaStandar->kuota ?? 10 }} Unit
                            </span>
                        </div>

                        <p class="text-muted small mb-3">Sudah termasuk matras, kapasitas nyaman untuk 2 hingga 3 orang pengunjung.</p>
                    </div>
                    <div>
                        <a href="{{ route('tenda.booking', ['paket' => 'standar']) }}" class="btn btn-dark w-100 fw-semibold btn-sm shadow-sm">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Paket 2: Tenda Keluarga -->
        <div class="col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden d-flex flex-column">
                <img src="{{ $tendaKeluarga && $tendaKeluarga->gambar ? asset('storage/' . $tendaKeluarga->gambar) : 'https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?auto=format&fit=crop&w=600&q=80' }}" class="card-img-top object-fit-cover" style="height: 180px;" alt="Tenda Keluarga">
                <div class="card-body text-center p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="mb-2 text-success fs-3">
                            <i class="bi bi-house-heart-fill"></i>
                        </div>
                        <h5 class="fw-bold mb-1">Tenda Keluarga (4-5 Orang)</h5>
                        <h6 class="text-primary fw-bold mb-2">Rp 85.000 <small class="text-muted fw-normal">/ malam</small></h6>

                        <!-- Informasi Kuota Camp Dinamis -->
                        <div class="mb-2">
                            <span class="badge bg-success px-2 py-1">
                                <i class="bi bi-people-fill me-1"></i> Kuota Tersedia: {{ $tendaKeluarga->kuota ?? 10 }} Unit
                            </span>
                        </div>

                        <p class="text-muted small mb-3">Tenda berukuran besar, luas, sangat cocok untuk liburan bersama keluarga atau rombongan kecil.</p>
                    </div>
                    <div>
                        <a href="{{ route('tenda.booking', ['paket' => 'keluarga']) }}" class="btn btn-dark w-100 fw-semibold btn-sm shadow-sm">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Paket 3: Paket Lengkap Camping -->
        <div class="col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden d-flex flex-column">
                <img src="{{ $paketLengkap && $paketLengkap->gambar ? asset('storage/' . $paketLengkap->gambar) : 'https://images.unsplash.com/photo-1510312305653-8ed496efae75?auto=format&fit=crop&w=600&q=80' }}" class="card-img-top object-fit-cover" style="height: 180px;" alt="Paket Lengkap Camping">
                <div class="card-body text-center p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="mb-2 text-success fs-3">
                            <i class="bi bi-fire"></i>
                        </div>
                        <h5 class="fw-bold mb-1">Paket Lengkap Camping</h5>
                        <h6 class="text-primary fw-bold mb-2">Rp 150.000 <small class="text-muted fw-normal">/ paket</small></h6>

                        <!-- Informasi Kuota Camp Dinamis -->
                        <div class="mb-2">
                            <span class="badge bg-success px-2 py-1">
                                <i class="bi bi-people-fill me-1"></i> Kuota Tersedia: {{ $paketLengkap->kuota ?? 10 }} Unit
                            </span>
                        </div>

                        <p class="text-muted small mb-3">Termasuk tenda besar, sleeping bag, matras, lampu camping, dan bonus kayu bakar.</p>
                    </div>
                    <div>
                        <a href="{{ route('tenda.booking', ['paket' => 'lengkap']) }}" class="btn btn-dark w-100 fw-semibold btn-sm shadow-sm">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endauth
<!-- ================= END SEKSI SEWA TENDA ================= -->

@endsection