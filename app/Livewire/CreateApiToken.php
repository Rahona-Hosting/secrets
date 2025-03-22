<?php

namespace Rahona\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Rahona\Helpers\Toast;

class CreateApiToken extends Component
{
    public $showModal = false;

    public $newToken = null;

    public $tokenName = '';

    public $expirationDate = '';

    public function createToken()
    {
        $this->validate([
            'tokenName' => 'required|min:3',
            'expirationDate' => 'nullable|date|after:today',
        ]);

        $expiration = $this->expirationDate ? Carbon::parse($this->expirationDate) : null;

        $token = auth()->user()->createToken(
            $this->tokenName,
            ['*'],
            $expiration
        );

        $this->newToken = $token->plainTextToken;
        $this->showModal = true;
        $this->tokenName = '';
        $this->expirationDate = '';

        $this->dispatch('api-created');
        Toast::success($this, __('api.add.success'));
    }

    public function open()
    {
        $this->showModal = true;
        $this->dispatch('requestDatepicker');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->newToken = null;
    }

    public function render()
    {
        return view('livewire.create-api-token');
    }
}
