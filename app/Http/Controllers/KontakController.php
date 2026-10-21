<?php

namespace App\Http\Controllers;

use App\Models\PesanKontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        return view('kontak');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'telepon' => ['nullable', 'string', 'max:20'],
            'subjek' => ['required', 'string', 'max:150'],
            'pesan' => ['required', 'string', 'max:2000'],
        ], [], [
            'nama' => 'nama',
            'email' => 'email',
            'telepon' => 'nomor telepon',
            'subjek' => 'subjek',
            'pesan' => 'pesan',
        ]);

        PesanKontak::create($data);

        return redirect()->route('kontak')
            ->with('sukses', 'Terima kasih, ' . $data['nama'] . '! Pesan Anda sudah kami terima.');
    }
}
