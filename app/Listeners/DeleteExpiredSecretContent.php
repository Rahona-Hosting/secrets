<?php

namespace Rahona\Listeners;

use Rahona\Events\SecretExpired;

class DeleteExpiredSecretContent
{
    public function handle(SecretExpired $event): void
    {
        $event->secret->forceFill(['data' => null])->save();
    }
}
