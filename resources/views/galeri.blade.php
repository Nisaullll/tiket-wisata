@extends('layouts.app')

@section('title', 'Galeri')

@section('content')
@include('partials.page-header', ['judul' => 'Galeri Foto', 'subjudul' => 'Dokumentasi keindahan spot wisata unggulan'])

<section class="container py-5">
    
    <!-- Tombol Tambah Foto (Khusus Admin / Pengelola) -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Dokumentasi Wisata</h4>
        <button type="button" class="btn btn-secondary fw-semibold" data-bs-toggle="modal" data-bs-target="#modalUploadFoto">
            <i class="bi bi-upload"></i> + Upload Foto Baru
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-3">
        @forelse ($galeri as $foto)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm h-100 position-relative">
                    
                    <!-- Gambar bisa diklik untuk preview modal besar -->
                    <div class="galeri-item rounded-top" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalFoto"
                         data-src="{{ asset('storage/' . $foto->gambar) }}" data-judul="{{ $foto->judul }}">
                        <img src="{{ asset('storage/' . $foto->gambar) }}" alt="{{ $foto->judul }}" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;">
                    </div>
                    
                    <div class="card-body py-2 d-flex flex-column justify-content-between">
                        <div>
                            <div class="fw-semibold small text-truncate">{{ $foto->judul }}</div>
                        </div>
                        
                        <!-- TOMBOL AKSI CRUD (UBAH & HAPUS) -->
                        <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top">
                            <!-- Tombol Trigger Modal Edit -->
                            <button type="button" class="btn btn-sm btn-outline-warning fw-semibold px-2 py-1" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalEditFoto{{ $foto->id }}">
                                <i class="bi bi-pencil-square"></i> Ubah
                            </button>

                            <!-- Form Hapus Data -->
                            <form action="{{ route('galeri.destroy', $foto->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger fw-semibold px-2 py-1">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- ================= MODAL EDIT FOTO (PER ITEM) ================= -->
            <div class="modal fade" id="modalEditFoto{{ $foto->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $foto->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header bg-warning text-dark">
                            <h5 class="modal-title fw-bold" id="modalEditLabel{{ $foto->id }}">Ubah Foto Galeri</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <form action="{{ route('galeri.update', $foto->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="modal-body text-start">
                                <div class="mb-3">
                                    <label for="judul_{{ $foto->id }}" class="form-label fw-semibold">Judul Foto</label>
                                    <input type="text" class="form-control" id="judul_{{ $foto->id }}" name="judul" value="{{ $foto->judul }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Foto Saat Ini</label>
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $foto->gambar) }}" class="img-thumbnail rounded" style="height: 100px; object-fit: cover;">
                                    </div>
                                    <label for="gambar_{{ $foto->id }}" class="form-label fw-semibold">Ganti File Foto (Opsional)</label>
                                    <input type="file" class="form-control" id="gambar_{{ $foto->id }}" name="gambar" accept="image/*">
                                    <div class="form-text">Biarkan kosong jika tidak ingin mengganti gambar.</div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-warning px-4 fw-semibold text-dark">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ================= END MODAL EDIT ================= -->

        @empty
            <div class="col-12 text-center py-4 text-muted">
                <p>Belum ada dokumentasi foto galeri yang diunggah.</p>
            </div>
        @endforelse
    </div>
</section>

<!-- ================= MODAL PREVIEW FOTO BESAR ================= -->
<div class="modal fade" id="modalFoto" tabindex="-1" aria-labelledby="modalFotoJudul" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-dark text-white border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="modalFotoJudul"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-0 text-center">
                <img src="" id="modalFotoGambar" class="img-fluid rounded" alt="" style="max-height: 80vh;">
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL FORM UPLOAD FOTO BARU ================= -->
<div class="modal fade" id="modalUploadFoto" tabindex="-1" aria-labelledby="modalUploadLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title fw-bold" id="modalUploadLabel">Upload Foto Galeri Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="destinasi_id" value="1">

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-semibold">Judul Foto</label>
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Contoh: Panorama Pagi Bukit Trianggulasi" required>
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label fw-semibold">File Foto (JPG/PNG/JPEG)</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required>
                        <div class="form-text">Maksimal ukuran file 2MB.</div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-secondary px-4 fw-semibold">Simpan & Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('modalFoto').addEventListener('show.bs.modal', function (e) {
        const sumber = e.relatedTarget;
        document.getElementById('modalFotoGambar').src = sumber.dataset.src;
        document.getElementById('modalFotoGambar').alt = sumber.dataset.judul;
        document.getElementById('modalFotoJudul').textContent = sumber.dataset.judul;
    });
</script>
@endpush