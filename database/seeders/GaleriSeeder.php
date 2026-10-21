<?php

namespace Database\Seeders;

use App\Models\Destinasi;
use App\Models\Galeri;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $destinasi = Destinasi::pluck('id', 'slug');
        $u = fn (string $id) => "https://images.unsplash.com/{$id}?auto=format&fit=crop&w=900&q=80";

        $data = [
            'labuan-bajo' => [
                ['judul' => 'Teluk Labuan Bajo', 'gambar' => 'img/labuan bajo.jpg'],
                ['judul' => 'Berlayar di Laut Flores', 'gambar' => $u('photo-1544644181-1484b3fdfc62')],
            ],
            'gunung-bromo' => [
                ['judul' => 'Kaldera Bromo', 'gambar' => 'img/bromo.jpg'],
                ['judul' => 'Pagi di Pegunungan', 'gambar' => $u('photo-1464822759023-fed622ff2c3b')],
            ],
            'candi-prambanan' => [
                ['judul' => 'Candi Utama Prambanan', 'gambar' => 'img/Candi prambanan.jpg'],
            ],
            'ranu-kumbolo' => [
                ['judul' => 'Danau Ranu Kumbolo', 'gambar' => 'img/Ranu kumbolo.jpg'],
                ['judul' => 'Danau di Lembah Hijau', 'gambar' => $u('photo-1506744038136-46273834b3fb')],
            ],
            'air-terjun-tumpak-sewu' => [
                ['judul' => 'Tirai Air Tumpak Sewu', 'gambar' => 'img/air terjun tumpak sewu.jpg'],
            ],
            'pantai-anyer' => [
                ['judul' => 'Pesisir Anyer', 'gambar' => 'img/Pantai anyer.jpg'],
                ['judul' => 'Pasir Putih', 'gambar' => $u('photo-1519046904884-53103b34b206')],
            ],
            'pink-beach-lombok' => [
                ['judul' => 'Laut Toska Lombok', 'gambar' => $u('photo-1507525428034-b723cf961d3e')],
            ],
            'pura-ulun-danu-beratan' => [
                ['judul' => 'Pura di Tepi Danau', 'gambar' => $u('photo-1537996194471-e657df975ab4')],
            ],
        ];

        foreach ($data as $slug => $fotos) {
            foreach ($fotos as $foto) {
                Galeri::updateOrCreate(
                    ['destinasi_id' => $destinasi[$slug], 'judul' => $foto['judul']],
                    ['gambar' => $foto['gambar']]
                );
            }
        }
    }
}
