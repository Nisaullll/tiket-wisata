<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Beranda') | {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('beranda') }}">
            <i class="bi bi-globe-asia-australia text-warning"></i> Pariwisata Nusantara
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuUtama"
                aria-controls="menuUtama" aria-expanded="false" aria-label="Buka menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menuUtama">
            <ul class="navbar-nav ms-auto">
                @php
                    $menu = [
                        'beranda' => 'Beranda',
                        'tentang' => 'Tentang',
                        'destinasi.index' => 'Destinasi',
                        'galeri' => 'Galeri',
                        'kontak' => 'Kontak',
                    ];
                @endphp
                @foreach ($menu as $rute => $label)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs(str_replace('.index', '.*', $rute)) ? 'active fw-semibold' : '' }}"
                           href="{{ route($rute) }}">{{ $label }}</a>
                    </li>
                @endforeach
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
                <h5 class="fw-bold"><i class="bi bi-globe-asia-australia text-warning"></i> Pariwisata Nusantara</h5>
                <p class="text-white-50 small">Memperkenalkan keindahan alam, warisan sejarah, dan budaya Indonesia kepada wisatawan sejak 2010.</p>
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
                    <li><i class="bi bi-envelope"></i> support@pariwisatanusantara.com</li>
                    <li><i class="bi bi-geo-alt"></i> Jl. Raya Pariwisata No. 45, Yogyakarta</li>
                </ul>
            </div>
        </div>
        <hr class="border-secondary">
        <p class="text-center text-white-50 small mb-0">&copy; {{ date('Y') }} Pariwisata Nusantara. Hak cipta dilindungi.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
