<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Destinasi extends Model
{
    protected $table = 'destinasi';

    protected $fillable = [
        'kategori_id', 'nama', 'slug', 'lokasi', 'ringkasan', 'deskripsi',
        'harga_tiket', 'jam_operasional', 'gambar', 'unggulan',
    ];

    protected $casts = [
        'harga_tiket' => 'integer',
        'unggulan' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function galeri(): HasMany
    {
        return $this->hasMany(Galeri::class);
    }

    public function getGambarUrlAttribute(): string
    {
        return gambar_url($this->gambar);
    }

    public function getHargaFormatAttribute(): string
    {
        return $this->harga_tiket > 0
            ? 'Rp ' . number_format($this->harga_tiket, 0, ',', '.')
            : 'Gratis';
    }
}
