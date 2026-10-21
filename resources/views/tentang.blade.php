@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
@include('partials.page-header', ['judul' => 'Tentang Kami', 'subjudul' => 'Mengenal lebih dekat Pariwisata Nusantara'])

<section class="container py-5">
    <div class="row g-5 align-items-center">
        <div class="col-lg-6">
            <h2 class="fw-bold">Profil Singkat</h2>
            <p class="text-muted">
                Pariwisata Nusantara didirikan pada tahun 2010 di Yogyakarta. Berawal dari komunitas pecinta jalan-jalan,
                kami kini menjadi pusat informasi wisata yang memperkenalkan destinasi alam, sejarah, dan budaya di berbagai
                provinsi di Indonesia.
            </p>
            <p class="text-muted">
                Kami bekerja sama dengan pengelola tempat wisata dan masyarakat lokal agar setiap kunjungan memberi manfaat
                bagi lingkungan dan perekonomian daerah.
            </p>
        </div>
        <div class="col-lg-6">
            <img src="{{ gambar_url('img/Ranu kumbolo.jpg') }}" class="img-fluid rounded-4 shadow" alt="Ranu Kumbolo">
        </div>
    </div>
</section>

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
            ['bi-people', 'Pemandu Lokal', 'Terhubung langsung dengan pemandu dari masyarakat setempat.'],
        ] as [$ikon, $judul, $teks])
            <div class="col-md-4">
                <i class="bi {{ $ikon }} display-5 text-warning"></i>
                <h5 class="fw-bold mt-2">{{ $judul }}</h5>
                <p class="text-muted">{{ $teks }}</p>
            </div>
        @endforeach
    </div>
</section>
@endsection
