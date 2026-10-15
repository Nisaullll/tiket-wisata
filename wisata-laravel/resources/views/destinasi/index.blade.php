@extends('layouts.app')

@section('title', 'Destinasi')

@section('content')
@include('partials.page-header', ['judul' => 'Destinasi Wisata', 'subjudul' => 'Temukan tempat liburan favorit Anda'])

<section class="container py-5">
    <form method="GET" action="{{ route('destinasi.index') }}" class="row g-2 mb-4">
        <div class="col-md-6">
            <input type="search" name="cari" value="{{ request('cari') }}" class="form-control"
                   placeholder="Cari nama atau lokasi destinasi...">
        </div>
        <div class="col-md-4">
            <select name="kategori" class="form-select">
                <option value="">Semua Kategori</option>
                @foreach ($kategori as $kat)
                    <option value="{{ $kat->slug }}" @selected(request('kategori') === $kat->slug)>{{ $kat->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-dark"><i class="bi bi-search"></i> Cari</button>
        </div>
    </form>

    @if ($destinasi->isEmpty())
        <div class="alert alert-secondary text-center">
            Destinasi tidak ditemukan. <a href="{{ route('destinasi.index') }}">Tampilkan semua</a>
        </div>
    @else
        <div class="row g-4">
            @foreach ($destinasi as $item)
                <div class="col-sm-6 col-lg-4">
                    @include('partials.destinasi-card', ['item' => $item])
                </div>
            @endforeach
        </div>
        <div class="mt-4 d-flex justify-content-center">
            {{ $destinasi->links() }}
        </div>
    @endif
</section>
@endsection
