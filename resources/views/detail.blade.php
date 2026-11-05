<div class="container my-5">
    <div class="row">
        <!-- 1. Operational CRM: Form Pemesanan Tiket -->
        <div class="col-md-6 mb-4">
            <div class="card shadow border-0 p-4">
                <h4 class="mb-3">🎟️ Pesan Tiket Masuk</h4>
                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf
                    
                    <!-- Kirim ID Destinasi & Tiket secara aman -->
                    <input type="hidden" name="destinasi_id" value="{{ $destinasi->id ?? 1 }}">
                    <input type="hidden" name="tiket_id" value="{{ optional($destinasi)->tikets?->first()->id ?? 1 }}">
                    
                    <div class="mb-3">
                        <label class="form-label">Jumlah Tiket</label>
                        <input type="number" name="jumlah_tiket" class="form-control" min="1" value="1" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Tanggal Kunjungan</label>
                        <input type="date" name="tanggal_kunjungan" class="form-control" required>
                    </div>
                    
                    <button type="submit" class="btn btn-success w-100 fw-semibold">Pesan Tiket Sekarang</button>
                </form>
            </div>
        </div>

        <!-- 2. Collaborative CRM: Form Ulasan & Penilaian -->
        <div class="col-md-6 mb-4">
            <div class="card shadow border-0 p-4">
                <h4 class="mb-3">⭐ Berikan Ulasan & Rating</h4>
                <form action="{{ route('ulasan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="destinasi_id" value="{{ $destinasi->id ?? 1 }}">
                    
                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <select name="rating" class="form-control" required>
                            <option value="5">⭐⭐⭐⭐⭐ - Sangat Memuaskan</option>
                            <option value="4">⭐⭐⭐⭐ - Puas</option>
                            <option value="3">⭐⭐⭐ - Cukup</option>
                            <option value="2">⭐⭐ - Kurang</option>
                            <option value="1">⭐ - Buruk</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Komentar / Pengalaman Anda</label>
                        <textarea name="komentar" class="form-control" rows="3" required placeholder="Tuliskan ulasan atau masukan Anda di sini..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 fw-semibold">Kirim Ulasan</button>
                </form>
            </div>
        </div>
    </div>
</div>