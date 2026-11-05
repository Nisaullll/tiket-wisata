@extends('layouts.app')

@section('title', 'Login Pengunjung')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow rounded-4 p-4">
                <h3 class="fw-bold mb-3 text-center">Login Akun</h3>
                <p class="text-muted text-center small mb-4">Masuk untuk memesan tiket wisata Desa Paninggaran.</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" required autofocus placeholder="nama@email.com">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="••••••••">
                    </div>

                    <button type="submit" class="btn btn-dark w-100 fw-semibold py-2 mb-3">Masuk Sekarang</button>
                </form>

                <div class="text-center small">
                    <span class="text-muted">Belum punya akun?</span> 
                    <a href="{{ route('register') }}" class="text-dark fw-bold text-decoration-none">Daftar di sini</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection