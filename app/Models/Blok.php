<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blok extends Model
{
    use HasFactory;

    protected $table = 'blok';
    protected $primaryKey = 'id_blok';

    protected $fillable = [
        'id_kebun',
        'kode_blok',
        'nama_blok',
        'luas_hektare',
    ];

    // Relasi balik ke Kebun
    public function kebun()
    {
        return $this->belongsTo(Kebun::class, 'id_kebun', 'id_kebun');
    }
}