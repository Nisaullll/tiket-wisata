@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
@include('partials.page-header', ['judul' => 'Hubungi Kami', 'subjudul' => 'Ada pertanyaan seputar destinasi? Kirimkan pesan Anda'])

<section class="container py-5">
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Informasi Kontak</h5>
                    <p><i class="bi bi-whatsapp text-success"></i> <b>WhatsApp CS</b><br>0812-3456-7890</p>
                    <p><i class="bi bi-envelope text-primary"></i> <b>Email</b><br>support@pariwisatanusantara.com</p>
                    <p><i class="bi bi-clock text-warning"></i> <b>Jam Operasional</b><br>Senin - Minggu, 08.00 - 17.00 WIB</p>
                    <p class="mb-0"><i class="bi bi-geo-alt text-danger"></i> <b>Alamat Kantor</b><br>Jl. Raya Pariwisata No. 45, Yogyakarta</p>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Kirim Pesan</h5>

                    @if (session('sukses'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="bi bi-check-circle"></i> {{ session('sukses') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('kontak.store') }}" novalidate>
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                       class="form-control @error('nama') is-invalid @enderror" required>
                                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                       class="form-control @error('email') is-invalid @enderror" required>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="telepon" class="form-label">No. Telepon <small class="text-muted">(opsional)</small></label>
                                <input type="tel" id="telepon" name="telepon" value="{{ old('telepon') }}"
                                       class="form-control @error('telepon') is-invalid @enderror">
                                @error('telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="subjek" class="form-label">Subjek</label>
                                <input type="text" id="subjek" name="subjek" value="{{ old('subjek') }}"
                                       class="form-control @error('subjek') is-invalid @enderror" required>
                                @error('subjek') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <label for="pesan" class="form-label">Pesan</label>
                                <textarea id="pesan" name="pesan" rows="5"
                                          class="form-control @error('pesan') is-invalid @enderror" required>{{ old('pesan') }}</textarea>
                                @error('pesan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-warning fw-semibold px-4">
                                    <i class="bi bi-send"></i> Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
