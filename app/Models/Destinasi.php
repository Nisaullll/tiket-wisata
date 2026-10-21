<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tiket;
use App\Models\Ulasan;
use App\Models\Kategori;

class Destinasi extends Model
{
    use HasFactory;

    // ⚠️ PERHATIKAN BARIS INI: 
    // Ganti 'destinasi' dengan nama tabel asli yang ada di database phpMyAdmin Anda jika berbeda (misal: 'tempat_wisata')
    protected $table = 'destinasi'; 

    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function tikets()
    {
        return $this->hasMany(Tiket::class, 'destinasi_id');
    }

    public function ulasans()
    {
        return $this->hasMany(Ulasan::class, 'destinasi_id');
    }
}