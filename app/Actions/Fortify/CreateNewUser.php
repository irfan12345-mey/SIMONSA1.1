<?php

namespace App\Actions\Fortify;

use App\Models\pengguna;
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
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'unique:pengguna'],
            'role' => ['required', 'in:pemilik,petugas'], // Admin tidak boleh daftar sendiri
            'password' => $this->passwordRules(),
        ])->validate();

        return Pengguna::create([
            'nama' => $input['nama'],
            'username' => $input['username'],
            'password' => Hash::make($input['password']),
            'role' => $input['role'], // Mengambil dari dropdown form
            'status_akun' => 'nonaktif', // Otomatis nonaktif
        ]);
    }
}
