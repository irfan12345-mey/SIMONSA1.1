<?php

namespace App\Actions\Fortify;

use App\Models\Pengguna; 
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(Pengguna $user, array $input): void
    {
        Validator::make($input, [
            'nama' => ['required', 'string', 'max:255'],
            
            // PERBAIKAN: Beritahu Laravel nama kolom unik dan nama primary key-nya
            'username' => [
                'required', 
                'string', 
                'max:50', 
                Rule::unique('pengguna', 'username')->ignore($user->id_pengguna, 'id_pengguna')
            ],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        $user->forceFill([
            'nama' => $input['nama'],
            'username' => $input['username'],
        ])->save();
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(Pengguna $user, array $input): void
    {
        $user->forceFill([
            'nama' => $input['nama'],
            'username' => $input['username'],
        ])->save();
    }
}