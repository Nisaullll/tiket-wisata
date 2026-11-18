@extends('layouts.app')

@section('title', 'Login Pengunjung')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow rounded-4 p-4 bg-white mb-3">
                <div class="text-center mb-4">
                    <div class="bg-dark text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 60px; height: 60px;">
                        <i class="bi bi-person-lock fs-3"></i>
                    </div>
                    <h3 class="fw-bold mb-1">Masuk ke Akun</h3>
                    <p class="text-muted small mb-0">Masuk untuk memesan tiket wisata atau booking sewa tenda di Desa Wisata Paninggaran.</p>
                </div>

                <!-- Pesan Error / Status Validasi Login -->
                @if ($errors->any())
                    <div class="alert alert-danger small py-2 mb-3">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus placeholder="nama@email.com">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="••••••••">
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label small text-muted" for="remember">
                                Ingat Saya
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 fw-semibold py-2 mb-3 shadow-sm">Masuk Sekarang</button>
                </form>

                <div class="text-center small">
                    <span class="text-muted">Belum punya akun?</span> 
                    <a href="{{ route('register') }}" class="text-dark fw-bold text-decoration-none">Daftar di sini</a>
                </div>
            </div>

            <!-- Kotak Pintasan Khusus Admin -->
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-light text-center">
                <p class="small text-muted mb-2"><i class="bi bi-shield-lock-fill text-danger me-1"></i> Merupakan pengelola / administrator sistem?</p>
                <a href="{{ route('admin.login') }}" class="btn btn-outline-danger btn-sm fw-semibold w-100">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Melalui Portal Login Admin
                </a>
            </div>

        </div>
    </div>
</div>
@endsection