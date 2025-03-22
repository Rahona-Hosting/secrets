<?php

namespace Rahona\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Rahona\Helpers\Toast;

class UpdatePasswordForm extends Component
{
    public $current_password = '';

    public $password = '';

    public $password_confirmation = '';

    public function updatePassword()
    {
        $this->validate([
            'current_password' => ['required', 'string', 'current_password'],
            'password' => ['required', 'string', Password::defaults(), 'confirmed'],
        ]);

        Auth::user()->update([
            'password' => Hash::make($this->password),
        ]);

        $this->reset(['current_password', 'password', 'password_confirmation']);

        Toast::success($this, __('profile.password.success'));
    }

    public function render()
    {
        return view('livewire.update-password-form');
    }
}
