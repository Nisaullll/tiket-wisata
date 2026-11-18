<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan Tiket Saya</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="fw-bold mb-1"><i class="bi bi-ticket-perforated-fill text-warning me-2"></i> Riwayat Pesanan Tiket Saya</h3>
                        <p class="text-muted small mb-0">Daftar transaksi dan status pemesanan tiket wisata Anda.</p>
                    </div>
                    <a href="{{ route('beranda') }}" class="btn btn-outline-dark btn-sm fw-semibold">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-dark text-uppercase small">
                                    <tr>
                                        <th class="py-3 ps-4">Kode Transaksi</th>
                                        <th class="py-3">Nama Pemesan</th>
                                        <th class="py-3">Tanggal Kunjungan</th>
                                        <th class="py-3">Jumlah</th>
                                        <th class="py-3">Total Harga</th>
                                        <th class="py-3">Status</th>
                                        <th class="py-3 text-end pe-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($riwayatTransaksi ?? [] as $trx)
                                        <tr>
                                            <td class="ps-4 fw-bold text-primary">#{{ $trx->id }}</td>
                                            <td>
                                                <i class="bi bi-person-circle text-secondary me-1"></i>
                                                {{ $trx->user->name ?? Auth::user()->name }}
                                            </td>
                                            <td>{{ date('d M Y', strtotime($trx->tanggal_kunjungan)) }}</td>
                                            <td>{{ $trx->jumlah_tiket }} Orang</td>
                                            <td class="fw-semibold text-success">Rp {{ number_format($trx->total_harga ?? 0, 0, ',', '.') }}</td>
                                            <td>
                                                @if(strtolower($trx->status ?? '') == 'lunas')
                                                    <span class="badge bg-success">Lunas</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">Menunggu Transfer</span>
                                                @endif
                                            </td>
                                            <td class="text-end pe-4">
                                                <a href="{{ route('transaksi.show', $trx->id) }}" class="btn btn-sm btn-dark fw-semibold">
                                                    <i class="bi bi-eye me-1"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-5 text-muted">
                                                <i class="bi bi-ticket-detailed fs-1 d-block mb-2 text-secondary"></i>
                                                <span>Belum ada riwayat pesanan tiket wisata.</span>
                                                <div class="mt-2">
                                                    <a href="{{ route('beranda') }}" class="btn btn-warning btn-sm fw-semibold text-dark">Pesan Tiket Sekarang</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>