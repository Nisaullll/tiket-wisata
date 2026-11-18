@extends('layouts.app')

@section('title', 'Galeri')

@section('content')
@include('partials.page-header', ['judul' => 'Galeri Foto', 'subjudul' => 'Dokumentasi keindahan spot wisata unggulan'])

<section class="container py-5">
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-3">
        @forelse ($galeri as $foto)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm h-100 position-relative">
                    
                    <!-- Gambar bisa diklik untuk preview modal besar -->
                    <div class="galeri-item rounded-top" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalFoto"
                         data-src="{{ asset('storage/' . $foto->gambar) }}" data-judul="{{ $foto->judul }}">
                        <img src="{{ asset('storage/' . $foto->gambar) }}" alt="{{ $foto->judul }}" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;">
                    </div>
                    
                    <div class="card-body py-2">
                        <div class="fw-semibold small text-truncate">{{ $foto->judul }}</div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-4 text-muted">
                <p>Belum ada dokumentasi foto galeri yang diunggah.</p>
            </div>
        @endforelse
    </div>
</section>

<!-- ================= MODAL PREVIEW FOTO BESAR ================= -->
<div class="modal fade" id="modalFoto" tabindex="-1" aria-labelledby="modalFotoJudul" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-dark text-white border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="modalFotoJudul"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-0 text-center">
                <img src="" id="modalFotoGambar" class="img-fluid rounded" alt="" style="max-height: 80vh;">
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