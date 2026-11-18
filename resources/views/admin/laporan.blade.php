{{-- Simpan sebagai: resources/views/admin/laporan.blade.php --}}
@extends('layouts.app')

@section('title', 'Panel Admin & Manajemen Konten')

@section('content')

{{-- PENGAMAN: hanya admin yang boleh membuka halaman ini (selain pengaman di route) --}}
@php abort_unless(Auth::check() && Auth::user()->usertype === 'admin', 403); @endphp

{{-- Data dihitung sekali di awal (sebelumnya dipanggil berulang di dalam tabel) --}}
@php
    $listTenda = [
        1 => 'Tenda Standar (2-3 Orang)',
        2 => 'Tenda Keluarga (4-5 Orang)',
        3 => 'Paket Lengkap Camping',
    ];
    $tendaRows = [];
    foreach ($listTenda as $k => $nama) {
        $tendaRows[$k] = \App\Models\Tenda::where('nama_paket', $nama)->first();
    }
    $galeriList = \App\Models\Galeri::latest()->get();
@endphp

{{-- ================= STYLE SIDEBAR ================= --}}
<style>
    .admin-sidebar {
        position: sticky;
        top: 80px;                       /* sesuaikan dengan tinggi navbar */
        max-height: calc(100vh - 100px);
        overflow-y: auto;
        background: #fff;
        border-radius: 1rem;
        padding: 1.25rem 1rem;
        box-shadow: 0 .125rem .5rem rgba(0, 0, 0, .08);
    }
    .admin-sidebar .grp-title {
        display: flex;
        align-items: center;
        gap: .6rem;
        font-weight: 700;
        font-size: .95rem;
        margin: 1.1rem 0 .4rem;
    }
    .admin-sidebar .grp-title:first-child { margin-top: 0; }
    .admin-sidebar .nav-link {
        color: #212529;
        padding: .5rem .9rem;
        margin-left: 1.9rem;
        border-radius: .6rem;
        font-size: .92rem;
    }
    .admin-sidebar .nav-link:hover { background: #f1f3f5; }
    .admin-sidebar .nav-link.active {
        background: #e9ecef;
        font-weight: 700;
        color: #000;
    }
    .admin-layout { display: flex; gap: 1.5rem; align-items: flex-start; }
    .admin-sidebar-wrap { width: 280px; flex: none; }
    .admin-content { flex: 1; min-width: 0; }
    @media (max-width: 767.98px) {
        .admin-layout { flex-direction: column; }
        .admin-sidebar-wrap { width: 100%; }
        .admin-content { width: 100%; }
    }
    /* hanya bagian yang dipilih di sidebar yang tampil */
    [data-pane]:not(.pane-active) { display: none !important; }
</style>

<div class="container-fluid py-4 px-md-4">
<div class="admin-layout">

    {{-- ================= SIDEBAR PANEL ================= --}}
    <div class="admin-sidebar-wrap">
        {{-- Tombol menu: hanya muncul di layar kecil (HP) --}}
        <button class="btn btn-dark w-100 mb-2 d-md-none" type="button"
                data-bs-toggle="collapse" data-bs-target="#sidebarCollapse"
                aria-expanded="false" aria-controls="sidebarCollapse">
            <i class="bi bi-list me-1"></i> Menu Panel Admin
        </button>
        {{-- Di layar >= 768px selalu tampil, di HP bisa dibuka/tutup --}}
        <div class="collapse d-md-block" id="sidebarCollapse">
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="grp-title"><i class="bi bi-images text-success"></i> Manajemen Konten</div>
            <nav class="nav flex-column">
                <a class="nav-link" href="#" data-pane-link="foto-fasilitas">Foto Fasilitas</a>
                <a class="nav-link" href="#" data-pane-link="paket-tenda">Paket Tenda &amp; Kuota</a>
                <a class="nav-link" href="#" data-pane-link="status-kuota">Status Kuota Tenda</a>
                <a class="nav-link" href="#" data-pane-link="galeri">Galeri Foto Wisata</a>
            </nav>

            <div class="grp-title"><i class="bi bi-ticket-perforated text-secondary"></i> Transaksi</div>
            <nav class="nav flex-column">
                <a class="nav-link" href="#" data-pane-link="pengunjung">Daftar Pengunjung</a>
            </nav>

            <div class="grp-title"><i class="bi bi-star-fill text-warning"></i> Ulasan</div>
            <nav class="nav flex-column">
                <a class="nav-link" href="#" data-pane-link="ulasan">Ulasan &amp; Rating</a>
            </nav>
        </aside>
        </div>{{-- /collapse --}}
    </div>

    {{-- ================= KONTEN UTAMA ================= --}}
    <div class="admin-content">

    <!-- Header Panel Admin -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h2 class="fw-bold mb-1">Panel Admin & Manajemen Konten Wisata</h2>
            <p class="text-muted small mb-0">Kelola foto fasilitas, paket tenda, galeri, serta pantau laporan transaksi dan ulasan pengunjung.</p>
        </div>
        <a href="{{ route('beranda') }}" class="btn btn-outline-dark fw-semibold">Kembali ke Beranda</a>
    </div>

    <!-- Alert Notifikasi Sukses / Pesan -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger rounded-4 shadow-sm mb-4">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <!-- ================= 1. MANAJEMEN FOTO & KUOTA FASILITAS & TENDA ================= -->
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white" data-pane="foto-fasilitas paket-tenda status-kuota">
        <h4 class="fw-bold mb-3"><i class="bi bi-images text-success me-2"></i>Manajemen Foto Fasilitas & Paket Tenda</h4>
        <p class="text-muted small mb-4">Ubah atau perbarui foto fasilitas, kuota, serta paket tenda yang tampil di halaman beranda secara dinamis.</p>

        <div class="row g-4 mb-4" data-pane="foto-fasilitas paket-tenda">
            <!-- Form Pengelolaan Fasilitas -->
            <div class="col-md-6" data-pane="foto-fasilitas">
                <div class="p-3 border rounded-4 bg-light">
                    <h5 class="fw-bold mb-3">Foto Fasilitas (Parkir, Spot Foto, Toilet)</h5>
                    <form action="{{ route('admin.fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Pilih Fasilitas</label>
                            <select name="judul" class="form-select form-select-sm" required>
                                <option value="Area Parkir Luas">Area Parkir Luas</option>
                                <option value="Spot Foto & Gazebo">Spot Foto & Gazebo</option>
                                <option value="Toilet & Mushola">Toilet & Mushola</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Upload Foto Baru</label>
                            <input type="file" name="gambar" class="form-control form-control-sm" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn btn-dark btn-sm w-100 fw-semibold">Simpan / Perbarui Foto Fasilitas</button>
                    </form>
                </div>
            </div>

            <!-- Form Pengelolaan Paket Tenda & Kuota -->
            <div class="col-md-6" data-pane="paket-tenda">
                <div class="p-3 border rounded-4 bg-light">
                    <h5 class="fw-bold mb-3">Foto & Kuota Paket Tenda & Camping</h5>
                    <form action="{{ route('admin.tenda.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Pilih Paket Tenda</label>
                            <select name="nama_paket" class="form-select form-select-sm" required>
                                @foreach($listTenda as $namaPaket)
                                    <option value="{{ $namaPaket }}">{{ $namaPaket }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Jumlah Kuota Camp Tersedia</label>
                            <input type="number" name="kuota" class="form-control form-control-sm" placeholder="Contoh: 15" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Upload Foto Baru (Opsional)</label>
                            <input type="file" name="gambar" class="form-control form-control-sm" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-success btn-sm w-100 fw-semibold">Simpan / Perbarui Paket Tenda</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabel Ringkasan Kuota Paket Tenda Aktif & Aksi -->
        <h6 class="fw-bold mb-2" data-pane="status-kuota">Status Kuota Paket Tenda & Pengelolaan</h6>
        <div class="table-responsive" data-pane="status-kuota">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Paket Tenda</th>
                        <th>Kuota Tersedia</th>
                        <th>Status Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listTenda as $key => $namaPaket)
                        @php $tendaData = $tendaRows[$key]; @endphp
                        <tr>
                            <td>{{ $key }}</td>
                            <td class="fw-semibold">{{ $namaPaket }}</td>
                            <td>
                                <span class="badge bg-success">
                                    {{ $tendaData ? $tendaData->kuota . ' Unit' : 'Belum diatur (Default: 10)' }}
                                </span>
                            </td>
                            <td>
                                @if($tendaData && $tendaData->gambar)
                                    <span class="text-success small fw-semibold"><i class="bi bi-check-circle"></i> Ada Foto</span>
                                @else
                                    <span class="text-muted small">Belum ada foto</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <!-- Tombol Ubah / Upload (Trigger Modal Edit Tenda) -->
                                    <button type="button" class="btn btn-sm btn-warning fw-semibold px-2 py-1 text-dark"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditTenda{{ $key }}" title="Ubah Kuota & Foto">
                                        <i class="bi bi-pencil-square"></i> Ubah / Upload
                                    </button>

                                    <!-- Tombol Hapus -->
                                    @if($tendaData)
                                        <form action="{{ route('admin.tenda.destroy', $tendaData->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger fw-semibold px-2 py-1" onclick="return confirm('Yakin ingin mereset/menghapus data paket tenda ini?')" title="Hapus Data">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- ================= MODAL EDIT TENDA (di luar tabel agar HTML valid) ================= --}}
        @foreach($listTenda as $key => $namaPaket)
            @php $tendaData = $tendaRows[$key]; @endphp
            <div class="modal fade" id="modalEditTenda{{ $key }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header bg-warning text-dark">
                            <h5 class="modal-title fw-bold">Ubah Kuota & Foto: {{ $namaPaket }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <form action="{{ route('admin.tenda.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body text-start">
                                <input type="hidden" name="nama_paket" value="{{ $namaPaket }}">

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Jumlah Kuota Camp</label>
                                    <input type="number" class="form-control" name="kuota" value="{{ $tendaData->kuota ?? 10 }}" min="0" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Foto Saat Ini</label>
                                    <div class="mb-2">
                                        @if($tendaData && $tendaData->gambar)
                                            <img src="{{ asset('storage/' . $tendaData->gambar) }}" class="img-thumbnail rounded" style="height: 90px; object-fit: cover;" alt="Foto {{ $namaPaket }}">
                                        @else
                                            <span class="text-muted small d-block">Belum ada foto yang diunggah.</span>
                                        @endif
                                    </div>
                                    <label class="form-label fw-semibold">Upload / Ganti Foto Baru (Opsional)</label>
                                    <input type="file" class="form-control" name="gambar" accept="image/*">
                                    <div class="form-text">Biarkan kosong jika hanya ingin mengubah kuotanya saja.</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-warning btn-sm px-4 fw-semibold text-dark">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- ================= 2. MANAJEMEN UPLOAD & KELOLA GALERI FOTO ================= -->
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white" data-pane="galeri">
        <h4 class="fw-bold mb-3"><i class="bi bi-collection text-success me-2"></i>Manajemen Galeri Foto Wisata</h4>
        <p class="text-muted small mb-4">Unggah foto baru ke galeri atau ubah dan hapus foto galeri yang sudah ada.</p>

        <!-- Form Upload Galeri Baru -->
        <div class="p-3 border rounded-4 bg-light mb-4">
            <h5 class="fw-bold mb-3">Tambah Foto Galeri Baru</h5>
            <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label small fw-semibold">Judul / Keterangan Foto</label>
                        <input type="text" name="judul" class="form-control form-control-sm" placeholder="Contoh: Suasana Pagi di Camping Ground" required>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label small fw-semibold">Pilih File Foto</label>
                        <input type="file" name="gambar" class="form-control form-control-sm" accept="image/*" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-success btn-sm w-100 fw-semibold">Upload</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tabel Daftar Galeri untuk Dikelola (Ubah / Hapus) -->
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <h5 class="fw-bold mb-0">Daftar Foto Galeri Aktif</h5>
            <span class="badge bg-secondary">Total: {{ $galeriList->count() }} Foto</span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Preview</th>
                        <th>Judul Foto</th>
                        <th>Waktu Upload</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($galeriList as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="rounded shadow-sm" style="width: 70px; height: 50px; object-fit: cover;">
                            </td>
                            <td class="fw-semibold">{{ $item->judul }}</td>
                            <td><small class="text-muted">{{ $item->created_at ? $item->created_at->format('d M Y, H:i') : '-' }}</small></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <!-- Tombol Ubah (Trigger Modal Edit) -->
                                    <button type="button" class="btn btn-sm btn-warning fw-semibold px-2 py-1 text-dark"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditFotoAdmin{{ $item->id }}" title="Ubah Foto">
                                        <i class="bi bi-pencil-square"></i> Ubah
                                    </button>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger fw-semibold px-2 py-1" onclick="return confirm('Yakin ingin menghapus foto galeri ini?')" title="Hapus Foto">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada foto galeri yang diunggah.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ================= MODAL EDIT FOTO ADMIN (di luar tabel agar HTML valid) ================= --}}
        @foreach($galeriList as $item)
            <div class="modal fade" id="modalEditFotoAdmin{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header bg-warning text-dark">
                            <h5 class="modal-title fw-bold">Ubah Foto Galeri</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <form action="{{ route('admin.galeri.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="modal-body text-start">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Judul Foto</label>
                                    <input type="text" class="form-control" name="judul" value="{{ $item->judul }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Foto Saat Ini</label>
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $item->gambar) }}" class="img-thumbnail rounded" style="height: 90px; object-fit: cover;" alt="{{ $item->judul }}">
                                    </div>
                                    <label class="form-label fw-semibold">Ganti File Foto (Opsional)</label>
                                    <input type="file" class="form-control" name="gambar" accept="image/*">
                                    <div class="form-text">Biarkan kosong jika tidak ingin mengganti gambar.</div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-warning btn-sm px-4 fw-semibold text-dark">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- ================= 3. TABEL DATA PEMBELI TIKET & SEWA TENDA ================= -->
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white" data-pane="pengunjung">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <h5 class="fw-bold mb-0"><i class="bi bi-ticket-perforated text-secondary me-2"></i>Daftar Pengunjung (Tiket & Sewa Tenda)</h5>
            <span class="badge bg-secondary">Total: {{ count($transaksiList) }} Data</span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>Detail Pesanan</th>
                        <th>Tanggal Kunjungan / Menginap</th>
                        <th>Metode Pembayaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksiList as $index => $trx)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-semibold">
                                {{ $trx->user->name ?? 'Tamu / Pengunjung' }}
                                <br><small class="text-muted fw-normal">{{ $trx->user->email ?? '-' }}</small>
                            </td>
                            <td>
                                @if(isset($trx->kategori) && $trx->kategori == 'camping')
                                    <span class="badge bg-success mb-1">Sewa Tenda</span><br>
                                    <small class="fw-semibold">{{ $trx->paket_tenda ?? 'Paket Camping' }} ({{ $trx->jumlah_tiket }} Unit)</small>
                                @else
                                    <span class="badge bg-secondary mb-1">Tiket Masuk</span><br>
                                    <small class="fw-semibold">{{ $trx->jumlah_tiket }} Tiket</small>
                                @endif
                            </td>
                            <td>{{ $trx->tanggal_kunjungan }}</td>
                            <td>
                                <span class="badge bg-light text-dark border text-uppercase px-2 py-1">
                                    {{ $trx->metode_pembayaran ?? 'Dana / Transfer' }}
                                </span>
                            </td>
                            <td>
                                @if(isset($trx->status) && $trx->status == 'lunas')
                                    <span class="badge bg-success px-2 py-1">Sudah Dibayar</span>
                                @else
                                    <span class="badge bg-warning text-dark px-2 py-1">Menunggu Transfer</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1 flex-wrap">
                                    <a href="{{ route('transaksi.show', $trx->id) }}" class="btn btn-sm btn-outline-dark" title="Lihat E-Tiket">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>

                                    {{-- Lihat bukti transfer yang diunggah pengunjung (sesuaikan nama kolom jika berbeda) --}}
                                    @if(!empty($trx->bukti_transfer))
                                        <a href="{{ asset('storage/' . $trx->bukti_transfer) }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-secondary" title="Lihat bukti transfer">
                                            <i class="bi bi-image"></i> Bukti
                                        </a>
                                    @endif

                                    @if(!isset($trx->status) || $trx->status != 'lunas')
                                        <form action="{{ route('admin.transaksi.lunas', $trx->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Konfirmasi pembayaran pesanan ini sudah lunas?')" title="Ubah status jadi lunas">
                                                <i class="bi bi-check-lg"></i> Verifikasi
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada data transaksi tiket atau sewa tenda dari pengunjung.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================= 4. TABEL DAFTAR ULASAN & RATING ================= -->
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white" data-pane="ulasan">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <h5 class="fw-bold mb-0"><i class="bi bi-star-fill text-warning me-2"></i>Daftar Pengunjung yang Memberikan Ulasan & Rating</h5>
            <span class="badge bg-secondary">Total Ulasan: {{ count($ulasanListAdmin) }}</span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Pengunjung</th>
                        <th>Rating</th>
                        <th>Komentar / Ulasan</th>
                        <th>Waktu Kirim</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ulasanListAdmin as $index => $ulasan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-semibold">
                                {{-- sama dengan halaman Ulasan pengunjung: kolom name, lalu relasi user --}}
                                {{ $ulasan->name ?? $ulasan->user->name ?? $ulasan->nama ?? 'Pengunjung Umum' }}
                                @if(isset($ulasan->user->email))
                                    <br><small class="text-muted fw-normal">{{ $ulasan->user->email }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="text-warning fw-bold">
                                    @for($i = 0; $i < $ulasan->rating; $i++)★@endfor
                                </span>
                                ({{ $ulasan->rating }}/5)
                            </td>
                            {{-- sama dengan halaman Ulasan pengunjung: kolom pesan, lalu komentar --}}
                            <td><span class="text-muted">"{{ $ulasan->pesan ?? $ulasan->komentar ?? '-' }}"</span></td>
                            <td><small class="text-muted">{{ $ulasan->created_at ? $ulasan->created_at->format('d M Y, H:i') : '-' }}</small></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada ulasan yang masuk dari pengunjung.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    </div>{{-- /admin-content --}}
</div>{{-- /admin-layout --}}
</div>{{-- /container-fluid --}}

{{-- ================= SCRIPT SIDEBAR: tampilkan satu bagian sesuai menu yang diklik ================= --}}
<script>
    (function () {
        const links  = document.querySelectorAll('#adminSidebar [data-pane-link]');
        const panes  = document.querySelectorAll('[data-pane]');
        const KEY    = 'adminPaneAktif';

        function tampilkan(nama) {
            panes.forEach(el => {
                const daftar = el.getAttribute('data-pane').split(' ');
                el.classList.toggle('pane-active', daftar.includes(nama));
            });
            links.forEach(l => l.classList.toggle('active', l.dataset.paneLink === nama));
            try { localStorage.setItem(KEY, nama); } catch (e) {}
        }

        links.forEach(l => l.addEventListener('click', function (e) {
            e.preventDefault();
            tampilkan(this.dataset.paneLink);
            // di HP: tutup menu setelah dipilih
            const c = document.getElementById('sidebarCollapse');
            if (c && c.classList.contains('show') && window.bootstrap) {
                bootstrap.Collapse.getOrCreateInstance(c).hide();
            }
        }));

        // ingat bagian terakhir yang dibuka (berguna setelah simpan / upload / hapus)
        let awal = 'foto-fasilitas';
        try { awal = localStorage.getItem(KEY) || awal; } catch (e) {}
        if (!document.querySelector('#adminSidebar [data-pane-link="' + awal + '"]')) awal = 'foto-fasilitas';
        tampilkan(awal);
    })();
</script>
@endsection