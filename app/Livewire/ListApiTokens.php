<?php

namespace Rahona\Livewire;

use Laravel\Sanctum\PersonalAccessToken;
use Livewire\Component;
use Livewire\WithPagination;
use Rahona\Helpers\Toast;

class ListApiTokens extends Component
{
    use WithPagination;

    public $confirmingTokenDeletion = false;

    public $tokenIdToDelete;

    protected $listeners = ['api-created' => '$refresh'];

    public function confirmTokenDeletion($tokenId)
    {
        $this->confirmingTokenDeletion = true;
        $this->tokenIdToDelete = $tokenId;
    }

    public function deleteToken()
    {
        $token = PersonalAccessToken::findOrFail($this->tokenIdToDelete);

        if ($token->tokenable_id === auth()->id()) {
            $token->delete();
            $this->dispatch('token-deleted');
        }

        $this->confirmingTokenDeletion = false;
        $this->tokenIdToDelete = null;

        Toast::success($this, __('api.delete.success'));
    }

    public function render()
    {
        $tokens = auth()->user()->tokens()->latest()->paginate(10);

        return view('livewire.list-api-tokens', [
            'tokens' => $tokens,
        ]);
    }
}
