<?php

namespace Rahona\Livewire;

use Livewire\Component;
use Rahona\Helpers\Toast;

class NotificationPreferences extends Component
{
    public $notify_api_token_expiring;

    public $notify_secret_expired;

    public $notify_secret_accessed;

    public function mount()
    {
        $preferences = auth()->user()->notificationPreference;
        $this->notify_api_token_expiring = $preferences->notify_api_token_expiring;
        $this->notify_secret_expired = $preferences->notify_secret_expired;
        $this->notify_secret_accessed = $preferences->notify_secret_accessed;
    }

    public function updatedNotifyApiTokenExpiring()
    {
        $this->savePreference('notify_api_token_expiring');
    }

    public function updatedNotifySecretExpired()
    {
        $this->savePreference('notify_secret_expired');
    }

    public function updatedNotifySecretAccessed()
    {
        $this->savePreference('notify_secret_accessed');
    }

    private function savePreference($field)
    {
        auth()->user()->notificationPreference->update([
            $field => $this->{$field},
        ]);

        Toast::success($this, __('profile.notifications.notifications_updated'));
        $this->dispatch('hideMessage');
    }

    public function render()
    {
        return view('livewire.notification-preferences');
    }
}
