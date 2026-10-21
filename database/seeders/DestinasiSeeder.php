<?php

namespace Database\Seeders;

use App\Models\Destinasi;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class DestinasiSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = Kategori::pluck('id', 'slug');

        $data = [
            [
                'kategori' => 'pantai-bahari',
                'nama' => 'Labuan Bajo',
                'slug' => 'labuan-bajo',
                'lokasi' => 'Manggarai Barat, Nusa Tenggara Timur',
                'ringkasan' => 'Gerbang menuju Taman Nasional Komodo dengan gugusan pulau dan laut sebening kristal.',
                'deskripsi' => "Labuan Bajo adalah kota pelabuhan kecil di ujung barat Pulau Flores yang menjadi pintu masuk Taman Nasional Komodo, situs Warisan Dunia UNESCO.\n\nWisatawan dapat berlayar dengan kapal phinisi, mendaki Pulau Padar untuk menikmati panorama tiga teluk, bersnorkeling bersama pari manta, hingga melihat langsung komodo di habitat aslinya.",
                'harga_tiket' => 150000,
                'jam_operasional' => 'Setiap hari, 06.00 - 18.00 WITA',
                'gambar' => 'img/labuan bajo.jpg',
                'unggulan' => true,
            ],
            [
                'kategori' => 'pegunungan',
                'nama' => 'Gunung Bromo',
                'slug' => 'gunung-bromo',
                'lokasi' => 'Probolinggo, Jawa Timur',
                'ringkasan' => 'Gunung api aktif dengan lautan pasir dan matahari terbit paling terkenal di Jawa.',
                'deskripsi' => "Gunung Bromo berada di kawasan Taman Nasional Bromo Tengger Semeru. Kalderanya yang luas dikelilingi lautan pasir yang memukau.\n\nAktivitas favorit adalah menyaksikan matahari terbit dari Penanjakan, menunggang kuda melintasi lautan pasir, dan mendaki anak tangga menuju bibir kawah.",
                'harga_tiket' => 54000,
                'jam_operasional' => 'Setiap hari, 24 jam',
                'gambar' => 'img/bromo.jpg',
                'unggulan' => true,
            ],
            [
                'kategori' => 'sejarah-budaya',
                'nama' => 'Candi Prambanan',
                'slug' => 'candi-prambanan',
                'lokasi' => 'Sleman, Daerah Istimewa Yogyakarta',
                'ringkasan' => 'Kompleks candi Hindu terbesar di Indonesia peninggalan abad ke-9.',
                'deskripsi' => "Candi Prambanan dibangun pada abad ke-9 Masehi dan dipersembahkan untuk Trimurti: Brahma, Wisnu, dan Siwa. Candi utamanya menjulang setinggi 47 meter.\n\nPengunjung dapat menikmati relief kisah Ramayana di dinding candi serta pertunjukan Sendratari Ramayana di panggung terbuka saat malam hari.",
                'harga_tiket' => 50000,
                'jam_operasional' => 'Setiap hari, 06.30 - 17.00 WIB',
                'gambar' => 'img/Candi prambanan.jpg',
                'unggulan' => true,
            ],
            [
                'kategori' => 'pegunungan',
                'nama' => 'Ranu Kumbolo',
                'slug' => 'ranu-kumbolo',
                'lokasi' => 'Lumajang, Jawa Timur',
                'ringkasan' => 'Danau jernih di ketinggian 2.400 mdpl, tempat singgah para pendaki Semeru.',
                'deskripsi' => "Ranu Kumbolo adalah danau air tawar yang berada di jalur pendakian Gunung Semeru. Airnya tenang dan memantulkan langit serta bukit di sekelilingnya.\n\nTempat ini menjadi lokasi berkemah favorit pendaki, terutama untuk menyaksikan matahari terbit di antara dua bukit. Jangan lewatkan Tanjakan Cinta dan padang lavender Oro-Oro Ombo.",
                'harga_tiket' => 35000,
                'jam_operasional' => 'Mengikuti jadwal buka jalur pendakian',
                'gambar' => 'img/Ranu kumbolo.jpg',
                'unggulan' => false,
            ],
            [
                'kategori' => 'air-terjun',
                'nama' => 'Air Terjun Tumpak Sewu',
                'slug' => 'air-terjun-tumpak-sewu',
                'lokasi' => 'Lumajang, Jawa Timur',
                'ringkasan' => 'Air terjun bertingkat berbentuk tirai raksasa dengan latar Gunung Semeru.',
                'deskripsi' => "Tumpak Sewu berarti \"seribu air terjun\". Aliran airnya jatuh dari tebing setinggi sekitar 120 meter membentuk tirai setengah lingkaran yang megah.\n\nPengunjung bisa menikmatinya dari panorama atas atau turun ke dasar lembah melalui jalur tangga dan bebatuan untuk merasakan percikan airnya dari dekat.",
                'harga_tiket' => 20000,
                'jam_operasional' => 'Setiap hari, 06.00 - 17.00 WIB',
                'gambar' => 'img/air terjun tumpak sewu.jpg',
                'unggulan' => true,
            ],
            [
                'kategori' => 'pantai-bahari',
                'nama' => 'Pantai Anyer',
                'slug' => 'pantai-anyer',
                'lokasi' => 'Serang, Banten',
                'ringkasan' => 'Pantai berpasir putih yang mudah dijangkau dari Jakarta dengan mercusuar bersejarah.',
                'deskripsi' => "Pantai Anyer terletak di pesisir barat Pulau Jawa dan menjadi tujuan liburan akhir pekan favorit warga Jabodetabek.\n\nSelain berenang dan bermain pasir, pengunjung dapat mengunjungi Mercusuar Cikoneng peninggalan Belanda serta menikmati matahari terbenam di Selat Sunda.",
                'harga_tiket' => 25000,
                'jam_operasional' => 'Setiap hari, 24 jam',
                'gambar' => 'img/Pantai anyer.jpg',
                'unggulan' => false,
            ],
            [
                'kategori' => 'pantai-bahari',
                'nama' => 'Pink Beach Lombok',
                'slug' => 'pink-beach-lombok',
                'lokasi' => 'Lombok Timur, Nusa Tenggara Barat',
                'ringkasan' => 'Pantai dengan pasir bernuansa merah muda dan air laut toska yang tenang.',
                'deskripsi' => "Pantai Tangsi atau Pink Beach Lombok memiliki pasir berwarna merah muda yang berasal dari serpihan karang merah bercampur pasir putih.\n\nPerairannya yang tenang sangat cocok untuk snorkeling. Dari bukit di sisi pantai, pengunjung bisa melihat panorama laut lepas dan pulau-pulau kecil di sekitarnya.",
                'harga_tiket' => 10000,
                'jam_operasional' => 'Setiap hari, 07.00 - 18.00 WITA',
                'gambar' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80',
                'unggulan' => false,
            ],
            [
                'kategori' => 'sejarah-budaya',
                'nama' => 'Pura Ulun Danu Beratan',
                'slug' => 'pura-ulun-danu-beratan',
                'lokasi' => 'Tabanan, Bali',
                'ringkasan' => 'Pura ikonik yang seolah mengapung di tepi Danau Beratan yang sejuk.',
                'deskripsi' => "Pura Ulun Danu Beratan dibangun pada abad ke-17 untuk memuja Dewi Danu, dewi air dan kesuburan. Bangunan meru bertingkatnya tampak mengapung saat air danau sedang pasang.\n\nBerada di dataran tinggi Bedugul, kawasan ini berhawa sejuk dan dikelilingi taman bunga serta perbukitan hijau.",
                'harga_tiket' => 75000,
                'jam_operasional' => 'Setiap hari, 07.00 - 19.00 WITA',
                'gambar' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
                'unggulan' => false,
            ],
        ];

        foreach ($data as $item) {
            $item['kategori_id'] = $kategori[$item['kategori']];
            unset($item['kategori']);

            Destinasi::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
