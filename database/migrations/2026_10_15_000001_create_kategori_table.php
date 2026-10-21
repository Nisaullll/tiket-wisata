<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Buat tabel tikets terlebih dahulu
        Schema::create('tikets', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tiket')->nullable();
            $table->integer('harga')->default(15000);
            $table->timestamps();
        });

        // 2. Buat tabel transaksis setelah tabel tikets ada
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tiket_id');
            $table->integer('jumlah_tiket');
            $table->integer('total_harga');
            $table->date('tanggal_kunjungan');
            $table->string('status');
            $table->timestamps();

            // Opsional: Foreign key (pastikan tabel tikets sudah di atas)
            $table->foreign('tiket_id')->references('id')->on('tikets')->onDelete('cascade');
        });

        // 3. Buat tabel ulasans
        Schema::create('ulasans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('destinasi_id');
            $table->integer('rating');
            $table->text('komentar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ulasans');
        Schema::dropIfExists('transaksis');
        Schema::dropIfExists('tikets');
    }
};