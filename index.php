<?php
// Mulai Session untuk menyimpan data keranjang belanja
session_start();

// Daftar destinasi wisata utama beserta harga, deskripsi, dan gambar utama
$destinasi = [
    "1" => [
        "nama" => "Pantai pink beach lombok", 
        "harga" => 50000, 
        "desc" => "Pantai berpasir putih dengan pemandangan matahari terbenam yang memukau.", 
        "img" => "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80"
    ],
    
    "3" => [
        "nama" => "Pegunungan Sejuk", 
        "harga" => 40000, 
        "desc" => "Wisata alam pegunungan dengan udara yang asri dan hamparan hijau.", 
        "img" => "https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=600&q=80"
    ],
    "4" => [
        "nama" => "Labuan bajo", 
        "harga" => 120000, 
        "desc" => "Pusat hiburan seru dan wahana permainan lengkap untuk seluruh keluarga.", 
        "img" => "img/labuan bajo.jpg"
    ]
];

// Daftar Galeri Foto dengan Nama Spot Wisata yang Unik & Berbeda
$galeri_foto = [
    [
        "id_destinasi" => "1",
        "nama" => "Ranu kumbolo",
        "harga" => 50000,
        "img" => "img/Ranu kumbolo.jpg"
    ],
    [
        "id_destinasi" => "1",
        "nama" => "Pasir Putih ",
        "harga" => 50000,
        "img" => "https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&w=600&q=80"
    ],
    [
        "id_destinasi" => "1",
        "nama" => "Bali",
        "harga" => 50000,
        "img" => "https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=600&q=80"
    ],
    [
        "id_destinasi" => "2",
        "nama" => "Candi prambanan",
        "harga" => 75000,
        "img" => "img/Candi prambanan.jpg"
    ],
    [
        "id_destinasi" => "2",
        "nama" => "Relief & Arca Purbakala",
        "harga" => 75000,
        "img" => "img/Pantai anyer.jpg"
    ],
    [
        "id_destinasi" => "2",
        "nama" => "air terjun tumpak sewu",
        "harga" => 75000,
        "img" => "img/air terjun tumpak sewu.jpg"
    ],
    [
        "id_destinasi" => "3",
        "nama" => "Puncak Bukit Pegunungan Sejuk",
        "harga" => 40000,
        "img" => "https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=600&q=80"
    ],
    [
        "id_destinasi" => "3",
        "nama" => "Danau Hijau Pegunungan",
        "harga" => 40000,
        "img" => "https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80"
    ],
    [
        "id_destinasi" => "3",
        "nama" => "Bromo",
        "harga" => 40000,
        "img" => "img/bromo.jpg"
    ],
    [
        "id_destinasi" => "4",
        "nama" => "Wahana Seru Keluarga",
        "harga" => 120000,
        "img" => "https://images.unsplash.com/photo-1513883049090-d0b7439799bf?auto=format&fit=crop&w=600&q=80"
    ],
    [
        "id_destinasi" => "4",
        "nama" => "Taman Bermain Anak",
        "harga" => 120000,
        "img" => "https://images.unsplash.com/photo-1543783207-ec64e4d95325?auto=format&fit=crop&w=600&q=80"
    ],
    [
        "id_destinasi" => "4",
        "nama" => "Kawasan Rekreasi Outdoor",
        "harga" => 120000,
        "img" => "https://images.unsplash.com/photo-1563245372-f21724e3856d?auto=format&fit=crop&w=600&q=80"
    ]
];

// Inisialisasi keranjang di session jika belum ada
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

$struk_pesan = null;
$error = null;
$page = $_GET['page'] ?? 'beranda';
$aksi = $_GET['aksi'] ?? '';
$id_pesan = $_GET['id'] ?? '';

// Proses Tambah ke Keranjang lewat ikon 🛒
if ($aksi == 'tambah_keranjang') {
    $id_wisata = $_GET['id'] ?? '';
    if (array_key_exists($id_wisata, $destinasi)) {
        if (isset($_SESSION['keranjang'][$id_wisata])) {
            $_SESSION['keranjang'][$id_wisata]['jumlah'] += 1;
        } else {
            $_SESSION['keranjang'][$id_wisata] = [
                "nama" => $destinasi[$id_wisata]['nama'],
                "harga" => $destinasi[$id_wisata]['harga'],
                "jumlah" => 1
            ];
        }
    }
    header("Location: ?page=keranjang");
    exit();
}

// Proses Update / Edit Jumlah Tiket di Keranjang
if ($_SERVER["REQUEST_METHOD"] == "POST" && $aksi == 'update_keranjang') {
    $id_item = $_POST['id_item'] ?? '';
    $jumlah_baru = intval($_POST['jumlah_baru'] ?? 1);
    if (isset($_SESSION['keranjang'][$id_item])) {
        if ($jumlah_baru > 0) {
            $_SESSION['keranjang'][$id_item]['jumlah'] = $jumlah_baru;
        } else {
            unset($_SESSION['keranjang'][$id_item]);
        }
    }
    header("Location: ?page=keranjang");
    exit();
}

// Proses Hapus Item dari Keranjang
if ($aksi == 'hapus') {
    $id_hapus = $_GET['id'] ?? '';
    if (isset($_SESSION['keranjang'][$id_hapus])) {
        unset($_SESSION['keranjang'][$id_hapus]);
    }
    header("Location: ?page=keranjang");
    exit();
}

// Proses Kosongkan Keranjang
if ($aksi == 'kosongkan') {
    $_SESSION['keranjang'] = [];
    header("Location: ?page=keranjang");
    exit();
}

// Proses Submit Checkout / Pesan Sekarang
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['proses_checkout'])) {
    $nama = trim($_POST['nama'] ?? '');
    $telepon = trim($_POST['telepon'] ?? '');
    $tanggal = $_POST['tanggal'] ?? '';
    $metode_pembayaran = $_POST['metode_pembayaran'] ?? '';

    if (empty($nama) || empty($telepon) || empty($tanggal) || empty($metode_pembayaran)) {
        $error = "Semua kolom data diri, tanggal, dan metode pembayaran wajib diisi!";
    } else {
        $items_pesanan = [];
        $total_bayar = 0;

        if ($aksi == 'pesan_satuan' && array_key_exists($id_pesan, $destinasi)) {
            $jumlah = intval($_POST['jumlah'] ?? 1);
            $harga = $destinasi[$id_pesan]['harga'];
            $subtotal = $harga * $jumlah;
            $items_pesanan[] = [
                "nama" => $destinasi[$id_pesan]['nama'],
                "harga" => $harga,
                "jumlah" => $jumlah,
                "subtotal" => $subtotal
            ];
            $total_bayar = $subtotal;
        } else {
            foreach ($_SESSION['keranjang'] as $item) {
                $subtotal = $item['harga'] * $item['jumlah'];
                $items_pesanan[] = [
                    "nama" => $item['nama'],
                    "harga" => $item['harga'],
                    "jumlah" => $item['jumlah'],
                    "subtotal" => $subtotal
                ];
                $total_bayar += $subtotal;
            }
            $_SESSION['keranjang'] = [];
        }

        $struk_pesan = [
            "kode" => "TRIP-" . date("Ymd") . "-" . rand(1000, 9999),
            "nama" => $nama,
            "telepon" => $telepon,
            "tanggal" => date('d-m-Y', strtotime($tanggal)),
            "metode_pembayaran" => $metode_pembayaran,
            "waktu_transaksi" => date('d-m-Y H:i:s'),
            "items" => $items_pesanan,
            "total" => $total_bayar
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pariwisata Nusantara</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 0; }
        
        /* Navbar Styling */
        .navbar { background-color: #2c3e50; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; color: white; }
        .navbar h1 { margin: 0; font-size: 20px; }
        .nav-links a { color: white; text-decoration: none; margin-left: 20px; font-weight: bold; padding: 8px 12px; border-radius: 4px; transition: background 0.3s; }
        .nav-links a:hover, .nav-links a.active { background-color: #34495e; }

        /* Container Content */
        .container { max-width: 900px; background: white; padding: 30px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); margin: 30px auto; }
        h2, h3 { color: #333; }
        
        /* Grid untuk Destinasi / Galeri */
        .grid-destinasi { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 20px; }
        .card { border: 1px solid #ddd; border-radius: 6px; overflow: hidden; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .card img { width: 100%; height: 150px; object-fit: cover; }
        .card-body { padding: 15px; }
        .card-title { font-size: 16px; font-weight: bold; margin: 0 0 10px; color: #2c3e50; }
        .card-price { color: #28a745; font-weight: bold; margin-bottom: 10px; }
        .card-desc { font-size: 13px; color: #666; margin-bottom: 15px; }
        
        /* Galeri Foto Luas di Beranda dengan Tombol Aksi */
        .galeri-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-top: 15px; }
        .galeri-item { border-radius: 6px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1); background: #fff; border: 1px solid #ddd; display: flex; flex-direction: column; justify-content: space-between; }
        .galeri-item img { width: 100%; height: 140px; object-fit: cover; display: block; transition: transform 0.3s; }
        .galeri-item img:hover { transform: scale(1.05); }
        .galeri-body { padding: 12px; }
        .galeri-title { font-size: 15px; font-weight: bold; color: #2c3e50; margin-bottom: 5px; }
        .galeri-price { color: #28a745; font-weight: bold; font-size: 13px; margin-bottom: 10px; }
        .galeri-actions { display: flex; gap: 6px; padding: 0 12px 12px 12px; align-items: center; }

        /* Tombol Aksi di Card */
        .card-actions { display: flex; gap: 8px; align-items: center; }
        .btn-card { flex: 1; display: inline-block; background: #28a745; color: white; padding: 8px 10px; text-decoration: none; border-radius: 4px; font-size: 13px; text-align: center; }
        .btn-card:hover { background: #218838; }
        .btn-cart-icon { display: inline-block; background: #007bff; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px; font-size: 14px; text-align: center; }
        .btn-cart-icon:hover { background: #0056b3; }

        /* Form & Struk Styling */
        label { font-weight: bold; display: block; margin-top: 10px; font-size: 14px; }
        input[type="text"], input[type="tel"], input[type="date"], input[type="number"], select { width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #28a745; color: white; border: none; padding: 10px 15px; font-size: 15px; border-radius: 4px; cursor: pointer; font-weight: bold; width: 100%; }
        button:hover { background-color: #218838; }
        .error { background-color: #fee2e2; color: #dc2626; padding: 10px; border-radius: 6px; text-align: center; margin-bottom: 15px; font-size: 14px; }
        
        .cart-section, .struk { background: #f8f9fa; padding: 20px; border-radius: 8px; margin-top: 20px; border: 1px solid #e9ecef; }
        table.cart-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table.cart-table th, table.cart-table td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; font-size: 14px; }
        table.cart-table th { background-color: #e9ecef; color: #333; }
        .btn-hapus { background-color: #dc3545; color: white; padding: 5px 10px; border-radius: 4px; text-decoration: none; font-size: 12px; }
        .btn-hapus:hover { background-color: #c82333; }
        .btn-edit { background-color: #ffc107; color: #333; padding: 4px 8px; border-radius: 4px; border: none; font-weight: bold; cursor: pointer; font-size: 12px; }
        .btn-edit:hover { background-color: #e0a800; }
        .btn-kosongkan { background-color: #6c757d; color: white; padding: 8px 12px; border-radius: 4px; text-decoration: none; font-size: 13px; display: inline-block; margin-top: 10px; }
        .btn-kosongkan:hover { background-color: #5a6268; }
    </style>
</head>
<body>

<!-- Navbar Menu -->
<div class="navbar">
    <h1>🌍 Pariwisata Nusantara</h1>
    <div class="nav-links">
        <a href="?page=beranda" class="<?= ($page == 'beranda') ? 'active' : ''; ?>">Beranda</a>
        <a href="?page=keranjang" class="<?= ($page == 'keranjang') ? 'active' : ''; ?>">Keranjang (<?= count($_SESSION['keranjang']); ?>)</a>
        <a href="?page=kontak" class="<?= ($page == 'kontak') ? 'active' : ''; ?>">Kontak</a>
    </div>
</div>

<div class="container">
    <?php if ($page == 'beranda' && $aksi == 'pesan_satuan' && array_key_exists($id_pesan, $destinasi)): ?>
        <!-- FORM CHECKOUT PESAN SEKARANG (SATUAN) DI BERANDA -->
        <h2>Form Checkout Pesanan</h2>
        <p>Destinasi Pilihan: <b><?= $destinasi[$id_pesan]['nama']; ?></b> (Rp <?= number_format($destinasi[$id_pesan]['harga'], 0, ',', '.'); ?> / tiket)</p>

        <?php if ($error): ?>
            <div class="error"><?= $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="hidden" name="proses_checkout" value="1">
            <label for="nama">Nama Lengkap Pemesan:</label>
            <input type="text" name="nama" id="nama" required>

            <label for="telepon">Nomor WhatsApp / Telepon:</label>
            <input type="tel" name="telepon" id="telepon" required>

            <label for="jumlah">Jumlah Tiket:</label>
            <input type="number" name="jumlah" id="jumlah" min="1" value="1" required>

            <label for="tanggal">Tanggal Kunjungan:</label>
            <input type="date" name="tanggal" id="tanggal" required>

            <label for="metode_pembayaran">Metode Pembayaran:</label>
            <select name="metode_pembayaran" id="metode_pembayaran" required>
                <option value="">-- Pilih Metode Pembayaran --</option>
                <option value="DANA">DANA (E-Wallet)</option>
                <option value="Transfer Bank">Transfer Bank (BCA / Mandiri / BNI)</option>
                <option value="ShopeePay">ShopeePay</option>
            </select>

            <button type="submit">Konfirmasi & Cetak Struk</button>
        </form>

    <?php elseif ($page == 'beranda'): ?>
        <!-- HALAMAN BERANDA -->
        <h2>Sejarah & Pesona Pariwisata Nusantara</h2>
        <p style="line-height: 1.6; color: #555;">
            <b>Pariwisata Nusantara</b> didirikan sejak tahun 2010 dengan misi utama memperkenalkan kekayaan alam, situs warisan sejarah purbakala, serta pusat rekreasi keluarga terbaik di seluruh penjuru negeri. Kami berkomitmen untuk melestarikan nilai-nilai budaya lokal sekaligus memberikan pengalaman liburan yang aman, nyaman, dan berkesan bagi setiap wisatawan.
        </p>
        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
        
        <h3>✨ Daftar Destinasi Wisata</h3>
        <p>Pilih tempat rekreasi favorit Anda dan dapatkan pengalaman liburan yang tak terlupakan.</p>
        
        <div class="grid-destinasi">
            <?php foreach ($destinasi as $key => $val): ?>
                <div class="card">
                    <img src="<?= $val['img']; ?>" alt="<?= $val['nama']; ?>">
                    <div class="card-body">
                        <div class="card-title"><?= $val['nama']; ?></div>
                        <div class="card-price">Rp <?= number_format($val['harga'], 0, ',', '.'); ?> / tiket</div>
                        <p class="card-desc"><?= $val['desc']; ?></p>
                        <div class="card-actions">
                            <a href="?page=beranda&aksi=pesan_satuan&id=<?= $key; ?>" class="btn-card">Pesan Sekarang</a>
                            <a href="?page=beranda&aksi=tambah_keranjang&id=<?= $key; ?>" class="btn-cart-icon" title="Tambah ke Keranjang">🛒</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <hr style="border: 0; border-top: 1px solid #eee; margin: 30px 0 20px 0;">
        <h3>📸 Galeri Koleksi Foto Spot Wisata Unggulan</h3>
        <p style="color: #666; font-size: 14px;">Berikut adalah dokumentasi berbagai spot keindahan alam beserta tombol pemesanannya:</p>
        
        <div class="galeri-grid">
            <?php foreach ($galeri_foto as $galeri): ?>
                <div class="galeri-item">
                    <img src="<?= $galeri['img']; ?>" alt="<?= $galeri['nama']; ?>">
                    <div class="galeri-body">
                        <div class="galeri-title"><?= $galeri['nama']; ?></div>
                        <div class="galeri-price">Rp <?= number_format($galeri['harga'], 0, ',', '.'); ?> / tiket</div>
                    </div>
                    <div class="galeri-actions">
                        <a href="?page=beranda&aksi=pesan_satuan&id=<?= $galeri['id_destinasi']; ?>" class="btn-card">Pesan Sekarang</a>
                        <a href="?page=beranda&aksi=tambah_keranjang&id=<?= $galeri['id_destinasi']; ?>" class="btn-cart-icon" title="Tambah ke Keranjang">🛒</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php elseif ($page == 'keranjang'): ?>
        <!-- HALAMAN KERANJANG -->
        <h2>Keranjang Belanja Anda</h2>
        <p>Tinjau daftar tiket wisata yang telah Anda masukkan ke keranjang, ubah jumlah jika diperlukan, atau lanjutkan ke pemesanan.</p>

        <?php if ($error): ?>
            <div class="error"><?= $error; ?></div>
        <?php endif; ?>

        <div class="cart-section" style="margin-top: 0;">
            <h3>🛒 Rincian Keranjang</h3>
            <?php if (empty($_SESSION['keranjang'])): ?>
                <p style="color: #666; font-style: italic;">Keranjang Anda masih kosong. Silakan tambahkan destinasi menggunakan tombol Pesan Sekarang atau ikon keranjang (🛒) di Beranda.</p>
            <?php else: ?>
                <table class="cart-table">
                    <tr>
                        <th>Destinasi Wisata</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $total_seluruhnya = 0;
                    foreach ($_SESSION['keranjang'] as $id => $item): 
                        $subtotal = $item['harga'] * $item['jumlah'];
                        $total_seluruhnya += $subtotal;
                    ?>
                        <tr>
                            <td><?= $item['nama']; ?></td>
                            <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                            <td>
                                <!-- Form Edit Jumlah Tiket Langsung di Tabel -->
                                <form method="POST" action="?page=keranjang&aksi=update_keranjang" style="display: flex; gap: 5px; align-items: center; margin: 0;">
                                    <input type="hidden" name="id_item" value="<?= $id; ?>">
                                    <input type="number" name="jumlah_baru" value="<?= $item['jumlah']; ?>" min="1" style="width: 60px; padding: 4px; margin: 0;">
                                    <button type="submit" class="btn-edit">Edit</button>
                                </form>
                            </td>
                            <td>Rp <?= number_format($subtotal, 0, ',', '.'); ?></td>
                            <td><a href="?page=keranjang&aksi=hapus&id=<?= $id; ?>" class="btn-hapus">Hapus</a></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" style="text-align: right; font-weight: bold;">Total Keseluruhan:</td>
                        <td colspan="2" style="font-weight: bold; color: #28a745; font-size: 16px;">Rp <?= number_format($total_seluruhnya, 0, ',', '.'); ?></td>
                    </tr>
                </table>
                <a href="?page=keranjang&aksi=kosongkan" class="btn-kosongkan" onclick="return confirm('Yakin ingin mengosongkan keranjang?')">Kosongkan Keranjang</a>

                <!-- FORM PEMESANAN / CHECKOUT KELOMPOK DARI KERANJANG -->
                <div style="margin-top: 30px; background: #fff; padding: 20px; border-radius: 6px; border: 1px solid #cbd5e1;">
                    <h3>Form Pemesanan Tiket (Checkout Keranjang)</h3>
                    <form method="POST" action="">
                        <input type="hidden" name="proses_checkout" value="1">
                        <label for="nama">Nama Lengkap Pemesan:</label>
                        <input type="text" name="nama" id="nama" required>

                        <label for="telepon">Nomor WhatsApp / Telepon:</label>
                        <input type="tel" name="telepon" id="telepon" required>

                        <label for="tanggal">Tanggal Kunjungan:</label>
                        <input type="date" name="tanggal" id="tanggal" required>

                        <label for="metode_pembayaran">Metode Pembayaran:</label>
                        <select name="metode_pembayaran" id="metode_pembayaran" required>
                            <option value="">-- Pilih Metode Pembayaran --</option>
                            <option value="DANA">DANA (E-Wallet)</option>
                            <option value="Transfer Bank">Transfer Bank (BCA / Mandiri / BNI)</option>
                            <option value="ShopeePay">ShopeePay</option>
                        </select>

                        <button type="submit">Pesan Sekarang (Checkout Semua)</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>

    <?php elseif ($page == 'kontak'): ?>
        <!-- HALAMAN KONTAK -->
        <h2>Hubungi Kami</h2>
        <p>Ada kendala atau pertanyaan seputar pemesanan tiket? Silakan hubungi layanan pelanggan kami:</p>
        <ul style="line-height: 1.8; color: #555;">
            <li><b>WhatsApp CS:</b> 0812-3456-7890</li>
            <li><b>Email:</b> support@pariwisatanusantara.com</li>
            <li><b>Jam Operasional:</b> Senin - Minggu (08.00 - 17.00 WIB)</li>
            <li><b>Alamat Kantor:</b> Jl. Raya Pariwisata No. 45, Yogyakarta</li>
        </ul>
    <?php endif; ?>

    <!-- TAMPILAN NOTA / STRUK SETELAH CHECKOUT BERHASIL -->
    <?php if ($struk_pesan): ?>
        <div class="struk">
            <h3>🧾 E-Ticket & Nota Pembayaran Resmi</h3>
            <p style="text-align: center; margin: 5px 0;"><b>Kode Booking:</b> <?= $struk_pesan['kode']; ?></p>
            <table style="width: 100%; margin-bottom: 15px;">
                <tr><td><b>Nama Pemesan</b></td><td>: <?= $struk_pesan['nama']; ?></td></tr>
                <tr><td><b>No. Telepon</b></td><td>: <?= $struk_pesan['telepon']; ?></td></tr>
                <tr><td><b>Tanggal Kunjungan</b></td><td>: <?= $struk_pesan['tanggal']; ?></td></tr>
                <tr><td><b>Metode Pembayaran</b></td><td>: <span style="color: #007bff; font-weight: bold;"><?= $struk_pesan['metode_pembayaran']; ?></span></td></tr>
                <tr><td><b>Waktu Transaksi</b></td><td>: <?= $struk_pesan['waktu_transaksi']; ?></td></tr>
            </table>

            <table class="cart-table">
                <tr>
                    <th>Destinasi</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
                <?php foreach ($struk_pesan['items'] as $it): ?>
                    <tr>
                        <td><?= $it['nama']; ?></td>
                        <td>Rp <?= number_format($it['harga'], 0, ',', '.'); ?></td>
                        <td><?= $it['jumlah']; ?> pcs</td>
                        <td>Rp <?= number_format($it['subtotal'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" style="text-align: right; font-weight: bold;">Total Bayar:</td>
                    <td style="font-weight: bold; color: #28a745; font-size: 16px;">Rp <?= number_format($struk_pesan['total'], 0, ',', '.'); ?></td>
                </tr>
            </table>
            <p style="text-align: center; margin-top: 20px; font-weight: bold; color: #28a745;">Terima kasih telah memesan tiket bersama kami! Selamat berlibur.</p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>