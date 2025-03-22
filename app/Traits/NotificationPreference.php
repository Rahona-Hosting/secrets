<?php

namespace Rahona\Traits;

trait NotificationPreference
{
    public function shouldNotify($notifiable, $type): bool
    {
        if (method_exists($notifiable, 'wantsNotification')) {
            return $notifiable->wantsNotification($type);
        }

        return false;
    }
}
