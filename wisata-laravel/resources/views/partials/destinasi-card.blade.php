<div class="card card-destinasi h-100 border-0 shadow-sm">
    <img src="{{ $item->gambar_url }}" class="card-img-top" alt="{{ $item->nama }}" loading="lazy">
    <div class="card-body d-flex flex-column">
        @if ($item->relationLoaded('kategori'))
            <span class="badge text-bg-warning align-self-start mb-2">{{ $item->kategori->nama }}</span>
        @endif
        <h5 class="card-title fw-bold mb-1">{{ $item->nama }}</h5>
        <p class="text-muted small mb-2"><i class="bi bi-geo-alt"></i> {{ $item->lokasi }}</p>
        <p class="card-text small flex-grow-1">{{ $item->ringkasan }}</p>
        <div class="d-flex justify-content-between align-items-center mt-2">
            <span class="fw-bold text-success">{{ $item->harga_format }}</span>
            <a href="{{ route('destinasi.show', $item) }}" class="btn btn-sm btn-outline-dark">
                Lihat Detail <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</div>
