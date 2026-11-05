<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    // Batasi kolom yang boleh diisi hanya judul dan gambar saja
    protected $fillable = [
        'judul',
        'gambar',
    ];
}