<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Beranda') | {{ config('app.name', 'Wisata Trianggulasi') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
    <div class="container-fluid px-3">
        
        <!-- BAGIAN KIRI: Logo Website -->
        <div class="d-flex align-items-center gap-3">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2 m-0" href="{{ route('beranda') }}">
                <i class="bi bi-globe-asia-australia text-warning"></i> Wisata Trianggulasi
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuUtama"
                aria-controls="menuUtama" aria-expanded="false" aria-label="Buka menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- BAGIAN TENGAH & KANAN: Menu Utama Website & Profil User -->
        <div class="collapse navbar-collapse w-100" id="menuUtama">
            @php
                $menu = [
                    'beranda' => 'Beranda',
                    'ulasan.index' => 'Ulasan & Laporan',
                    'galeri' => 'Galeri',
                    'kontak' => 'Kontak',
                ];
            @endphp

            <!-- Menu Navigasi Utama Website -->
            <ul class="navbar-nav mb-2 mb-lg-0 ms-auto align-items-lg-center">
                @foreach ($menu as $rute => $label)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs($rute) ? 'active fw-semibold text-warning' : '' }}"
                           href="{{ route($rute) }}">{{ $label }}</a>
                    </li>
                @endforeach
            </ul>

            <!-- Panel Akun / Login di Pojok Kanan -->
            <ul class="navbar-nav align-items-center ms-lg-3 me-0">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 text-white fw-semibold pe-0" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center shadow-sm fw-bold" style="width: 35px; height: 35px;">
                                <i class="bi bi-person-fill fs-5"></i>
                            </div>
                            <span>{{ Auth::user()->name }}</span>
                            @if(Auth::user()->usertype === 'admin')
                                <span class="badge bg-danger ms-1">Admin</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 mt-2 py-2" aria-labelledby="userDropdown" style="width: 220px;">
                            <!-- MENU BARU: Pesanan Tiket Saya -->
                            <li>
                                <a class="dropdown-item py-2 fw-semibold text-dark" href="{{ route('transaksi.laporan') }}">
                                    <i class="bi bi-ticket-perforated-fill me-2 text-warning"></i> Pesanan Tiket Saya
                                </a>
                            </li>
                            <li><hr class="dropdown-divider my-1"></li>

                            <!-- MENU LOGOUT -->
                            <li>
                                <a class="dropdown-item py-2 text-danger fw-semibold" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <!-- Jika Belum Login -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center justify-content-center bg-secondary bg-opacity-25 border border-secondary text-white rounded-circle shadow-sm m-0" href="#" id="loginDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 40px; height: 40px;" title="Menu Akun">
                            <i class="bi bi-person fs-5"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 p-2 mt-2" style="width: 250px;" aria-labelledby="loginDropdown">
                            <li class="px-3 py-2 text-center border-bottom mb-2">
                                <span class="fw-bold text-dark d-block small">Akses Masuk Sistem</span>
                                <span class="text-muted" style="font-size: 11px;">Silakan pilih portal akun Anda</span>
                            </li>
                            <li>
                                <a class="dropdown-item rounded-2 py-2 px-3 fw-semibold text-dark mb-1 d-flex align-items-center" href="{{ route('login') }}">
                                    <i class="bi bi-box-arrow-in-right me-2 fs-5 text-primary"></i> Login Pengunjung
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item rounded-2 py-2 px-3 fw-semibold text-danger mb-1 d-flex align-items-center" href="{{ route('admin.login') }}">
                                    <i class="bi bi-shield-lock me-2 fs-5"></i> Login Admin
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li><hr class="dropdown-divider my-1"></li>
                                <li>
                                    <a class="dropdown-item rounded-2 py-2 px-3 fw-semibold text-success d-flex align-items-center" href="{{ route('register') }}">
                                        <i class="bi bi-person-plus me-2 fs-5"></i> Register Pengunjung
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="flex-grow-1">
    @yield('content')
</main>

<footer class="bg-dark text-light pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-5">
                <h5 class="fw-bold"><i class="bi bi-globe-asia-australia text-warning"></i> Wisata Trianggulasi</h5>
                <p class="text-white-50 small">Memperkenalkan keindahan alam, warisan sejarah, dan budaya Indonesia kepada wisatawan.</p>
            </div>
            <div class="col-6 col-md-3">
                <h6 class="fw-bold">Menu</h6>
                <ul class="list-unstyled small">
                    @foreach ($menu as $rute => $label)
                        <li><a class="link-light link-opacity-75 text-decoration-none" href="{{ route($rute) }}">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-6 col-md-4">
                <h6 class="fw-bold">Hubungi Kami</h6>
                <ul class="list-unstyled small text-white-50">
                    <li><i class="bi bi-whatsapp"></i> 0812-3456-7890</li>
                    <li><i class="bi bi-envelope"></i> support@Trianggulasi.com</li>
                    <li><i class="bi bi-geo-alt"></i> Kecamatan Paninggaran, Kabupaten Pekalongan, Jawa Tengah</li>
                </ul>
            </div>
        </div>
        <hr class="border-secondary">
        <p class="text-center text-white-50 small mb-0">&copy; {{ date('Y') }} Wisata Trianggulasi. Hak cipta dilindungi.</p>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>