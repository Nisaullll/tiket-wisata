<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galeri extends Model
{
    protected $table = 'galeri';

    protected $fillable = ['destinasi_id', 'judul', 'gambar'];

    public function destinasi(): BelongsTo
    {
        return $this->belongsTo(Destinasi::class);
    }

    public function getGambarUrlAttribute(): string
    {
        return gambar_url($this->gambar);
    }
}
