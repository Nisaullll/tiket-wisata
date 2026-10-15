@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<section class="hero d-flex align-items-center text-white">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Jelajahi Pesona Nusantara</h1>
        <p class="lead col-lg-8 mx-auto">Dari pantai berpasir merah muda hingga candi berusia seribu tahun, temukan destinasi terbaik Indonesia di satu tempat.</p>
        <div class="d-flex gap-2 justify-content-center flex-wrap mt-4">
            <a href="{{ route('destinasi.index') }}" class="btn btn-warning btn-lg fw-semibold">Lihat Destinasi</a>
            <a href="{{ route('tentang') }}" class="btn btn-outline-light btn-lg">Tentang Kami</a>
        </div>
    </div>
</section>

<section class="container">
    <div class="row g-3 text-center position-relative" style="margin-top:-3rem">
        @foreach ([
            ['bi-map', $statistik['destinasi'], 'Destinasi Wisata'],
            ['bi-tags', $statistik['kategori'], 'Kategori'],
            ['bi-images', $statistik['foto'], 'Foto Galeri'],
        ] as [$ikon, $angka, $label])
            <div class="col-md-4">
                <div class="card border-0 shadow py-3">
                    <i class="bi {{ $ikon }} fs-2 text-warning"></i>
                    <div class="fs-3 fw-bold">{{ $angka }}</div>
                    <div class="text-muted small">{{ $label }}</div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<section class="container py-5">
    <div class="row align-items-center g-4">
        <div class="col-lg-6">
            <img src="{{ gambar_url('img/Candi prambanan.jpg') }}" class="img-fluid rounded-4 shadow" alt="Candi Prambanan">
        </div>
        <div class="col-lg-6">
            <h6 class="text-warning fw-bold text-uppercase">Sejarah Kami</h6>
            <h2 class="fw-bold">Sejarah &amp; Pesona Pariwisata Nusantara</h2>
            <p class="text-muted">
                <b>Pariwisata Nusantara</b> didirikan sejak tahun 2010 dengan misi utama memperkenalkan kekayaan alam,
                situs warisan sejarah, serta pusat rekreasi terbaik di seluruh penjuru negeri. Kami berkomitmen
                melestarikan nilai-nilai budaya lokal sekaligus memberikan pengalaman liburan yang aman, nyaman, dan berkesan.
            </p>
            <a href="{{ route('tentang') }}" class="btn btn-dark">Selengkapnya</a>
        </div>
    </div>
</section>

<section class="bg-body-tertiary py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
            <div>
                <h6 class="text-warning fw-bold text-uppercase mb-1">Pilihan Terbaik</h6>
                <h2 class="fw-bold mb-0">Destinasi Unggulan</h2>
            </div>
            <a href="{{ route('destinasi.index') }}" class="btn btn-outline-dark">Semua Destinasi</a>
        </div>
        <div class="row g-4">
            @foreach ($unggulan as $item)
                <div class="col-sm-6 col-lg-3">
                    @include('partials.destinasi-card', ['item' => $item])
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="container py-5">
    <h2 class="fw-bold text-center mb-4">Kategori Wisata</h2>
    <div class="row g-3">
        @foreach ($kategori as $kat)
            <div class="col-6 col-md-3">
                <a href="{{ route('destinasi.index', ['kategori' => $kat->slug]) }}"
                   class="card h-100 text-center text-decoration-none border-0 shadow-sm card-destinasi py-4">
                    <i class="bi {{ $kat->ikon }} fs-1 text-warning"></i>
                    <div class="fw-semibold mt-2 text-body">{{ $kat->nama }}</div>
                    <small class="text-muted">{{ $kat->destinasi_count }} destinasi</small>
                </a>
            </div>
        @endforeach
    </div>
</section>

<section class="bg-body-tertiary py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-2">
            <h2 class="fw-bold mb-0">Galeri Foto</h2>
            <a href="{{ route('galeri') }}" class="btn btn-outline-dark">Lihat Semua Foto</a>
        </div>
        <div class="row g-3">
            @foreach ($galeri as $foto)
                <div class="col-6 col-md-4">
                    <a href="{{ route('destinasi.show', $foto->destinasi) }}" class="d-block rounded-3 galeri-item shadow-sm">
                        <img src="{{ $foto->gambar_url }}" class="w-100 galeri-thumb" alt="{{ $foto->judul }}" loading="lazy">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="container py-5 text-center">
    <h2 class="fw-bold">Punya Pertanyaan?</h2>
    <p class="text-muted">Tim kami siap membantu merencanakan perjalanan Anda.</p>
    <a href="{{ route('kontak') }}" class="btn btn-warning btn-lg fw-semibold">Hubungi Kami</a>
</section>
@endsection
