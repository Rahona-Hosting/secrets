<?php

namespace Rahona\Listeners;

use Rahona\Events\SecretExpired;
use Rahona\Notifications\SecretExpiredNotification;

class SendSecretExpiredNotification
{
    public function handle(SecretExpired $event): void
    {
        $secret = $event->secret;

        if ($secret->user) {
            $secret->user->notify(new SecretExpiredNotification($secret));
            $secret->forceFill(['expiration_notified' => true])->save();
        }
    }
}
