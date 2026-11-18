@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
@include('partials.page-header', ['judul' => 'Tentang Kami', 'subjudul' => 'Mengenal lebih dekat Wisata Trianggulasi'])

<section class="container py-5">
    <div class="row g-5 align-items-center">
        <div class="col-lg-6">
            <h2 class="fw-bold">Profil Singkat</h2>
            <p class="text-muted">
                Secara historis dan geografis, Desa Sawangan di Kecamatan Paninggaran dikenal sebagai wilayah dataran tinggi di Kabupaten Pekalongan yang berbatasan langsung dengan jalur penghubung penting antara Pekalongan dan Banjarnegara. Wilayah ini didominasi oleh perbukitan asri, lahan pertanian, serta lanskap alam pegunungan yang sangat mirip dengan suasana kawasan Dieng.

Nama "Trianggulasi" sendiri diambil dari istilah titik triangulasi geodesi yang biasanya berada di puncak-puncak bukit tinggi sebagai referensi ukur tanah atau pemetaan wilayah zaman dulu. Karena letaknya yang berada di ketinggian strategis dengan pemandangan terbuka luas ke segala arah (360 degree view), masyarakat setempat bersama para penggerak pariwisata lokal akhirnya memanfaatkan potensi bukit ini menjadi destinasi wisata alam modern yang dikenal dengan nama Trianggulasi.Kehadiran destinasi ini awalnya dimotori oleh kesadaran masyarakat dan pemuda desa setempat untuk mengangkat potensi alam Desa Sawangan agar lebih dikenal luas oleh wisatawan luar daerah. Dari yang mulanya hanya sebuah kawasan bukit biasa yang kerap disinggahi oleh para pendaki atau pencinta alam untuk menikmati panorama matahari terbit (sunrise), kini tempat tersebut bertransformasi menjadi kawasan desa wisata terpadu yang memadukan keindahan alam, budaya lokal, hingga fasilitas rekreasi modern.
            </p>
            <p class="text-muted">
                Kami bekerja sama dengan pengelola tempat wisata dan masyarakat lokal agar setiap kunjungan memberi manfaat
                bagi lingkungan dan perekonomian daerah.
            </p>
        </div>
        <div class="col-lg-6">
            
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
@endsection
