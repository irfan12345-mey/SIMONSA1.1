<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blok', function (Blueprint $table) {
            $table->id('id_blok');
            $table->unsignedBigInteger('id_kebun');
            $table->string('kode_blok', 50);
            $table->string('nama_blok', 100)->nullable();
            $table->decimal('luas_hektare', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_kebun')->references('id_kebun')->on('kebun')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blok');
    }
};