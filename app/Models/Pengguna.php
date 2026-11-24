<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Wajib untuk Login
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class Pengguna extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasProfilePhoto, TwoFactorAuthenticatable;

    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';

    protected $fillable = [
        'nama',
        'username',
        'password',
        'role',
        'status_akun',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    // Relasi
    public function kebun()
    {
        return $this->hasMany(Kebun::class, 'id_pemilik', 'id_pengguna');
    }
}