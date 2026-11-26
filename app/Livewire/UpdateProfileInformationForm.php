<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfileInformationForm extends Component
{
    use WithFileUploads;

    public $state = [];
    public $photo;

    public function mount()
    {
        $this->state = Auth::user()->withoutRelations()->toArray();
    }

    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();

        // Validasi disesuaikan dengan kolom database kita (nama & username)
        Validator::make($this->state, [
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'unique:pengguna,username,' . Auth::id() . ',id_pengguna'],
        ])->validateWithBag('updateProfileInformation');

        // Simpan perubahan
        $updater->update(
            Auth::user(),
            $this->photo
                ? array_merge($this->state, ['photo' => $this->photo])
                : $this->state
        );

        $this->dispatch('saved');
    }

    public function deleteProfilePhoto()
    {
        Auth::user()->deleteProfilePhoto();
        $this->dispatch('refresh');
    }

        public function render()
    {
        return view('livewire.update-profile-information-form');
    }
}