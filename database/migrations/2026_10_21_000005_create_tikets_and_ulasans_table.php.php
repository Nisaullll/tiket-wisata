<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Buat tabel tikets
        if (!Schema::hasTable('tikets')) {
            Schema::create('tikets', function (Blueprint $table) {
                $table->id();
                $table->string('nama_tiket')->nullable();
                $table->integer('harga')->default(15000);
                $table->timestamps();
            });
        }

        // 2. Buat tabel transaksis (tanpa foreign key yang ketat agar bebas error)
        if (!Schema::hasTable('transaksis')) {
            Schema::create('transaksis', function (Blueprint $table) {
                $table->id();
                $table->string('kode_transaksi');
                $table->unsignedBigInteger('user_id')->default(1);
                $table->unsignedBigInteger('tiket_id')->default(1);
                $table->integer('jumlah_tiket');
                $table->integer('total_harga');
                $table->date('tanggal_kunjungan');
                $table->string('status')->default('paid');
                $table->timestamps();
            });
        }

        // 3. Buat tabel ulasans
        if (!Schema::hasTable('ulasans')) {
            Schema::create('ulasans', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->default(1);
                $table->unsignedBigInteger('destinasi_id')->default(1);
                $table->integer('rating');
                $table->text('komentar');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('ulasans');
        Schema::dropIfExists('transaksis');
        Schema::dropIfExists('tikets');
    }
};