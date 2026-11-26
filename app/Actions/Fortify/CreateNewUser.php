<?php

namespace App\Actions\Fortify;

use App\Models\Pengguna; // Perbaikan: Huruf 'P' harus kapital
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): Pengguna
    {
        Validator::make($input, [
            'nama' => ['required', 'string', 'max:100'], // Disesuaikan dengan database (max 100)
            'username' => ['required', 'string', 'max:50', 'unique:pengguna'],
            'role' => ['required', 'in:pemilik,petugas'], // Admin tidak boleh daftar sendiri
            'password' => $this->passwordRules(), // Menggunakan aturan password bawaan Fortify (min 8, confirmed)
        ])->validate();

        return Pengguna::create([
            'nama' => $input['nama'],
            'username' => $input['username'],
            'password' => Hash::make($input['password']),
            'role' => $input['role'],
            'status_akun' => 'nonaktif', // Otomatis nonaktif sesuai keinginan Anda
        ]);
    }
}