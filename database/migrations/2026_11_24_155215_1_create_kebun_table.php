<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kebun', function (Blueprint $table) {
            $table->id('id_kebun');
            $table->unsignedBigInteger('id_pemilik');
            $table->string('nama_kebun', 100);
            $table->string('lokasi', 255)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_pemilik')->references('id_pengguna')->on('pengguna')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kebun');
    }
};