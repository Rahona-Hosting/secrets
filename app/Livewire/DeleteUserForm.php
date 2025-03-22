<?php

namespace Rahona\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Rahona\Helpers\Toast;

class DeleteUserForm extends Component
{
    public $showDeleteModal = false;

    public $confirmationText = '';

    public function confirmUserDeletion()
    {
        $this->showDeleteModal = true;
    }

    public function deleteUser()
    {
        if ($this->confirmationText !== Auth::user()->email) {
            Toast::danger($this, __('profile.delete.confirm.error'));

            return;
        }

        $user = Auth::user();
        Auth::logout();
        $user->delete();

        redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.delete-user-form');
    }
}
