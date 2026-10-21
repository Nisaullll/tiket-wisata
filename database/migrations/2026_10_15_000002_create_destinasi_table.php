<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destinasi', function (Blueprint $table) {
            $table->id();
            // Menggunakan unsignedBigInteger biasa agar tidak error relasi foreign key
            $table->unsignedBigInteger('kategori_id')->default(1);
            $table->string('nama', 150);
            $table->string('slug', 170)->unique();
            $table->string('lokasi', 150);
            $table->string('ringkasan', 255);
            $table->text('deskripsi');
            $table->unsignedInteger('harga_tiket')->default(0);
            $table->string('jam_operasional', 100)->nullable();
            $table->string('gambar');
            $table->boolean('unggulan')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destinasi');
    }
};