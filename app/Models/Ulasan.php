<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    // Melindungi ID agar tidak bisa di-mass assign, kolom lainnya aman diisi
    protected $guarded = ['id'];

    /**
     * Relasi ke model Destinasi
     */
    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class, 'destinasi_id');
    }

    /**
     * Relasi ke model User (Pengguna yang memberi ulasan)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}