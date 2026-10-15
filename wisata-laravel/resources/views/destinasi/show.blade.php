@extends('layouts.app')

@section('title', $destinasi->nama)

@section('content')
<section class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('destinasi.index') }}">Destinasi</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $destinasi->nama }}</li>
        </ol>
    </nav>

    <img src="{{ $destinasi->gambar_url }}" class="w-100 rounded-4 shadow detail-cover mb-4" alt="{{ $destinasi->nama }}">

    <div class="row g-4">
        <div class="col-lg-8">
            <span class="badge text-bg-warning mb-2">{{ $destinasi->kategori->nama }}</span>
            <h1 class="fw-bold">{{ $destinasi->nama }}</h1>
            <p class="text-muted"><i class="bi bi-geo-alt"></i> {{ $destinasi->lokasi }}</p>
            <p class="lead">{{ $destinasi->ringkasan }}</p>
            @foreach (preg_split("/\n\s*\n/", $destinasi->deskripsi) as $paragraf)
                <p>{{ $paragraf }}</p>
            @endforeach

            @if ($destinasi->galeri->isNotEmpty())
                <h4 class="fw-bold mt-4 mb-3">Galeri {{ $destinasi->nama }}</h4>
                <div class="row g-3">
                    @foreach ($destinasi->galeri as $foto)
                        <div class="col-6 col-md-4">
                            <img src="{{ $foto->gambar_url }}" class="w-100 rounded-3 galeri-thumb" alt="{{ $foto->judul }}" loading="lazy">
                            <small class="text-muted">{{ $foto->judul }}</small>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm sticky-lg-top" style="top:5rem">
                <div class="card-body">
                    <h5 class="fw-bold">Informasi Kunjungan</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0">
                            <small class="text-muted d-block">Harga Tiket Masuk</small>
                            <span class="fs-4 fw-bold text-success">{{ $destinasi->harga_format }}</span>
                            <small class="text-muted">/ orang</small>
                        </li>
                        <li class="list-group-item px-0">
                            <small class="text-muted d-block">Jam Operasional</small>
                            <i class="bi bi-clock"></i> {{ $destinasi->jam_operasional ?? '-' }}
                        </li>
                        <li class="list-group-item px-0">
                            <small class="text-muted d-block">Lokasi</small>
                            <i class="bi bi-geo-alt"></i> {{ $destinasi->lokasi }}
                        </li>
                    </ul>
                    <a href="{{ route('kontak') }}" class="btn btn-warning w-100 fw-semibold mt-3">
                        <i class="bi bi-chat-dots"></i> Tanya Destinasi Ini
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@if ($lainnya->isNotEmpty())
<section class="bg-body-tertiary py-5 mt-4">
    <div class="container">
        <h3 class="fw-bold mb-4">Destinasi Lainnya</h3>
        <div class="row g-4">
            @foreach ($lainnya as $item)
                <div class="col-md-4">
                    @include('partials.destinasi-card', ['item' => $item])
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
