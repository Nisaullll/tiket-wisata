@extends('layouts.app')

@section('title', 'Galeri')

@section('content')
@include('partials.page-header', ['judul' => 'Galeri Foto', 'subjudul' => 'Dokumentasi keindahan spot wisata unggulan'])

<section class="container py-5">
    <div class="row g-3">
        @foreach ($galeri as $foto)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="galeri-item rounded-top" data-bs-toggle="modal" data-bs-target="#modalFoto"
                         data-src="{{ $foto->gambar_url }}" data-judul="{{ $foto->judul }} — {{ $foto->destinasi->nama }}">
                        <img src="{{ $foto->gambar_url }}" class="w-100 galeri-thumb" alt="{{ $foto->judul }}" loading="lazy">
                    </div>
                    <div class="card-body py-2">
                        <div class="fw-semibold small">{{ $foto->judul }}</div>
                        <a href="{{ route('destinasi.show', $foto->destinasi) }}" class="small text-decoration-none">
                            <i class="bi bi-geo-alt"></i> {{ $foto->destinasi->nama }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<div class="modal fade" id="modalFoto" tabindex="-1" aria-labelledby="modalFotoJudul" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-dark text-white border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="modalFotoJudul"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-0">
                <img src="" id="modalFotoGambar" class="w-100" alt="">
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('modalFoto').addEventListener('show.bs.modal', function (e) {
        const sumber = e.relatedTarget;
        document.getElementById('modalFotoGambar').src = sumber.dataset.src;
        document.getElementById('modalFotoGambar').alt = sumber.dataset.judul;
        document.getElementById('modalFotoJudul').textContent = sumber.dataset.judul;
    });
</script>
@endpush
