<?php

namespace Rahona\Livewire;

use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Rahona\Jobs\DeleteSecretContent;
use Rahona\Models\Secret;
use Rahona\Models\SecretAccess;
use Rahona\Models\User;
use Rahona\Notifications\SecretAccessedNotification;

class SecretViewer extends Component
{
    public Secret $secret;

    public bool $isE2EE;

    public bool $isRevealed = false;

    public bool $isDestroyed = false;

    protected $listeners = [
        'e2eeWrongPassword' => 'logIncorrectPassword',
        'e2eeCorrectPassword' => 'logCorrectPassword',
    ];

    public function mount(Secret $secret, bool $isE2EE)
    {
        $this->secret = $secret;
        $this->isE2EE = $isE2EE;
    }

    public function revealSecret()
    {
        $this->isRevealed = true;
        $this->dispatch('secretRevealed');

        $access = SecretAccess::create([
            'secret_id' => $this->secret->id,
            'ip' => Request::ip(),
            'user_agent' => Request::userAgent(),
            'secret_viewed' => true,
        ]);

        /** @var User $user */
        $this->secret->user->notify(new SecretAccessedNotification($access));

        if (! $this->secret->isViewable()) {
            DeleteSecretContent::dispatch($this->secret);
        }
    }

    public function closeSecret()
    {
        $this->dispatch('secretClosed');

        if (! $this->secret->isViewable()) {
            $this->secret->data = null;
            $this->secret->save();
            $this->isDestroyed = true;
        } else {
            $this->isRevealed = false;
        }
    }

    public function getIsLastViewProperty()
    {
        return $this->secret->remainingViews() === 0;
    }

    public function logIncorrectPassword()
    {
        $this->logPassword(false);
    }

    public function logCorrectPassword()
    {
        $this->logPassword(true);
    }

    private function logPassword(bool $correctPassword)
    {
        SecretAccess::create([
            'secret_id' => $this->secret->id,
            'ip' => Request::ip(),
            'user_agent' => Request::userAgent(),
            'password_incorrect' => ! $correctPassword,
            'password_correct' => $correctPassword,
            'secret_viewed' => $correctPassword,
        ]);
    }

    public function render()
    {
        return view('livewire.secret-viewer');
    }
}
