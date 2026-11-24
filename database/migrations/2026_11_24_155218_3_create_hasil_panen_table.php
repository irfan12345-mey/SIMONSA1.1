<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_panen', function (Blueprint $table) {
            $table->id('id_hasil');
            $table->unsignedBigInteger('id_blok');
            $table->unsignedBigInteger('id_petugas');
            $table->date('tanggal_panen');
            $table->decimal('berat_tbs_kg', 12, 2);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_blok')->references('id_blok')->on('blok')->onDelete('cascade');
            $table->foreign('id_petugas')->references('id_pengguna')->on('pengguna')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_panen');
    }
};