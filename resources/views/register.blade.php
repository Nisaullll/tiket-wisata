@extends('layouts.app')

@section('title', 'Daftar Akun Pengunjung')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow rounded-4 p-4">
                <h3 class="fw-bold mb-3 text-center">Daftar Akun Baru</h3>
                <p class="text-muted text-center small mb-4">Gunakan email pribadi Anda untuk mulai memesan tiket wisata.</p>

                <!-- Menampilkan Pesan Error Validasi (jika ada) -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show small py-2" role="alert">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="Masukkan nama lengkap Anda">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Email Pribadi</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="nama@email.com">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="Minimal 6 karakter">
                    </div>

                    <button type="submit" class="btn btn-dark w-100 fw-semibold py-2 mb-3">Daftar Sekarang</button>
                </form>

                <div class="text-center small">
                    <span class="text-muted">Sudah punya akun?</span> 
                    <a href="{{ route('login') }}" class="text-dark fw-bold text-decoration-none">Login di sini</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection