<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kebun extends Model
{
    use HasFactory;

    protected $table = 'kebun'; // TAMBAHKAN BARIS INI
    protected $primaryKey = 'id_kebun'; // Pastikan ini juga ada

    protected $fillable = [
        'id_pemilik',
        'nama_kebun',
        'lokasi',
        'keterangan',
    ];

    // Relasi ke pengguna
    public function pemilik()
    {
        return $this->belongsTo(Pengguna::class, 'id_pemilik', 'id_pengguna');
    }
}