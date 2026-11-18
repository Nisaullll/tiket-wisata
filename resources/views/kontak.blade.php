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
</section>
@endsection