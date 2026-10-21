<!-- === TAMBAHAN WIDGET CRM DI HALAMAN UTAMA === -->
<div class="container my-5">
    <div class="row text-center mb-4">
        <div class="col-12">
            <h2 class="fw-bold">Layanan Pengunjung & Sistem CRM Desa Wisata</h2>
            <p class="text-muted">Pesan tiket perjalanan Anda dan berikan ulasan terbaik untuk kemajuan wisata kami.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <!-- 1. Operational CRM (Akses Cepat Tiket) -->
        <div class="col-md-5 mb-3">
            <div class="card shadow border-0 p-4 bg-light">
                <h4 class="text-success mb-3">🎟️ Operational CRM (Pemesanan Tiket)</h4>
                <p class="text-muted small">Kelola pemesanan tiket wisata secara online dengan mudah dan cepat.</p>
                <a href="{{ route('login') }}" class="btn btn-success">Mulai Pesan Tiket</a>
            </div>
        </div>

        <!-- 2. Collaborative CRM (Akses Ulasan & Kontak) -->
        <div class="col-md-5 mb-3">
            <div class="card shadow border-0 p-4 bg-light">
                <h4 class="text-primary mb-3">⭐ Collaborative CRM (Ulasan & Layanan)</h4>
                <p class="text-muted small">Berikan rating, masukan, dan terhubung langsung dengan pusat layanan kami.</p>
                <a href="#kontak" class="btn btn-primary">Beri Ulasan / Kontak</a>
            </div>
        </div>
    </div>
</div>