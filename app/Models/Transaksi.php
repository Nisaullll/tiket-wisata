<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'user_id',
        'destinasi_id',
        'tiket_id',
        'jumlah_tiket',
        'total_harga',
        'tanggal_kunjungan',
        'metode_pembayaran',
        'status',
    ];

    /**
     * Relasi ke model User (Pemesan Tiket)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}