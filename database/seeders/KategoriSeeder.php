<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Pantai & Bahari', 'slug' => 'pantai-bahari', 'ikon' => 'bi-water'],
            ['nama' => 'Pegunungan', 'slug' => 'pegunungan', 'ikon' => 'bi-triangle'],
            ['nama' => 'Sejarah & Budaya', 'slug' => 'sejarah-budaya', 'ikon' => 'bi-bank'],
            ['nama' => 'Air Terjun', 'slug' => 'air-terjun', 'ikon' => 'bi-droplet'],
        ];

        foreach ($data as $item) {
            Kategori::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
