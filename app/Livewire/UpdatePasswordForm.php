<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Actions\UpdateUserPassword;
use Livewire\Component;

class UpdatePasswordForm extends Component
{
    public $state = [
        'current_password' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    public function updatePassword(UpdateUserPassword $updater)
    {
        $this->resetErrorBag();

        if (! Hash::check($this->state['current_password'], Auth::user()->password)) {
            throw ValidationException::withMessages([
                'current_password' => [__('Password saat ini tidak cocok.')],
            ]);
        }

        $this->validate([
            'state.password' => 'required|string|min:8|confirmed',
        ]);

        $updater->update(Auth::user(), $this->state);

        $this->dispatch('saved');

        $this->state = [
            'current_password' => '',
            'password' => '',
            'password_confirmation' => '',
        ];
    }

        public function render()
    {
        return view('livewire.update-password-form');
    }
}