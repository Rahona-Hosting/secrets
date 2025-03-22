<?php

namespace Rahona\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Rahona\Models\Secret;

class SecretsTable extends Component
{
    use WithPagination;

    public $filter = 'all';

    public $confirmingSecretDeletion = false;

    public $secretToDelete = null;

    protected $listeners = ['secret-created' => '$refresh'];

    public function mount()
    {
        $this->filter = 'all';
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function confirmSecretDeletion($secretId)
    {
        $this->secretToDelete = $secretId;
        $this->confirmingSecretDeletion = true;
    }

    public function cancelSecretDeletion()
    {
        $this->confirmingSecretDeletion = false;
        $this->secretToDelete = null;
    }

    public function deleteSecret()
    {
        $secret = Secret::find($this->secretToDelete);

        if ($secret && $secret->user_id === auth()->id()) {
            $secret->delete();
            $this->dispatch('secret-deleted');
        }

        $this->confirmingSecretDeletion = false;
        $this->secretToDelete = null;
    }

    public function getSecrets()
    {
        $query = auth()->user()->secrets()
            ->withCount(['access as view_count' => function ($query) {
                $query->where('secret_viewed', true);
            }]);

        switch ($this->filter) {
            case 'active':
                $query->where(function ($query) {
                    $query->whereNull('expires_at')
                        ->orWhere('expires_at', '>', now());
                })
                    ->whereDoesntHave('access', function ($query) {
                        $query->where('secret_viewed', true);
                    })
                    ->where(function ($query) {
                        $query->whereNull('max_views')
                            ->orWhereRaw('(SELECT COUNT(*) FROM secret_accesses WHERE secret_id = secrets.id AND secret_viewed = true) < secrets.max_views');
                    });
                break;
            case 'viewed':
                $query->where(function ($query) {
                    $query->whereHas('access', function ($query) {
                        $query->where('secret_viewed', true);
                    });
                })
                    ->orWhere(function ($query) {
                        $query->whereNotNull('max_views')
                            ->whereRaw('(SELECT COUNT(*) FROM secret_accesses WHERE secret_id = secrets.id AND secret_viewed = true) >= secrets.max_views');
                    });
                break;
            case 'expired':
                $query->where('expires_at', '<=', now())
                    ->whereDoesntHave('access', function ($query) {
                        $query->where('secret_viewed', true);
                    });
                break;
        }

        return $query->latest()->paginate(10);
    }

    public function render()
    {
        return view('livewire.secrets-table', [
            'secrets' => $this->getSecrets(),
        ]);
    }
}
