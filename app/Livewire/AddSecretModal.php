<?php

namespace Rahona\Livewire;

use Livewire\Component;
use Rahona\Helpers\Toast;
use Rahona\Models\Secret;

class AddSecretModal extends Component
{
    public $show = false;

    public $secret = '';

    public $max_views = 1;

    public $expiresAt;

    public $isE2EE = false;

    public $createdSecretUrl = null;

    public $urlCopied = false;

    protected $rules = [
        'secret' => 'required|min:1',
        'max_views' => 'required|numeric|min:1',
        'expiresAt' => 'required|date|after:now',
    ];

    protected $listeners = [
        'openAddSecretModal' => 'open',
        'secret-ready' => 'handleFinalSecret',
        'encryption-failed' => 'handleEncryptionError',
    ];

    public function mount()
    {
        $this->expiresAt = now()->addDay()->format('Y-m-d\TH:i');
    }

    public function open()
    {
        $this->reset(['secret', 'max_views', 'isE2EE', 'createdSecretUrl', 'urlCopied']);
        $this->expiresAt = now()->addDay()->format('Y-m-d\TH:i');
        $this->show = true;
        $this->dispatch('requestDatepicker');
    }

    public function close()
    {
        $this->show = false;
        $this->dispatch('secret-modal-closed');
    }

    public function createSecret()
    {
        $this->dispatch('prepare-secret', [
            'isE2EE' => $this->isE2EE,
        ]);
    }

    public function handleFinalSecret($secret)
    {
        $this->secret = $secret;

        $this->validate();

        /** @var Secret $secret */
        $secret = Secret::forceCreate([
            'data' => $this->secret,
            'max_views' => $this->max_views,
            'expires_at' => $this->expiresAt,
            'isE2EE' => $this->isE2EE,
            'user_id' => auth()->id(),
        ]);

        $this->createdSecretUrl = route('public.secret', ['url' => $secret->url]);
        $this->dispatch('secret-created');

        Toast::success($this, __('secret.add.success_toast'));
    }

    public function handleEncryptionError($message)
    {
        $this->addError('secret', $message);
    }

    public function copyUrl()
    {
        $this->urlCopied = true;
    }

    public function render()
    {
        return view('livewire.add-secret-modal');
    }
}
