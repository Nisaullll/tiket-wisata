<?php

namespace Database\Seeders;

use App\Models\PesanKontak;
use Illuminate\Database\Seeder;

class PesanKontakSeeder extends Seeder
{
    public function run(): void
    {
        PesanKontak::firstOrCreate(
            ['email' => 'budi.santoso@example.com'],
            [
                'nama' => 'Budi Santoso',
                'telepon' => '081234567890',
                'subjek' => 'Informasi paket rombongan',
                'pesan' => 'Apakah ada harga khusus untuk rombongan 30 orang ke Gunung Bromo?',
            ]
        );
    }
}
