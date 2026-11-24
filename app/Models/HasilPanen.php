<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPanen extends Model
{
    use HasFactory;

    protected $table = 'hasil_panen'; // INI YANG HARUS DITAMBAHKAN
    protected $primaryKey = 'id_hasil';

    protected $fillable = [
        'id_blok',
        'id_petugas',
        'tanggal_panen',
        'berat_tbs_kg',
        'keterangan',
    ];

    // Relasi
    public function blok()
    {
        return $this->belongsTo(Blok::class, 'id_blok', 'id_blok');
    }

    public function petugas()
    {
        return $this->belongsTo(Pengguna::class, 'id_petugas', 'id_pengguna');
    }
}