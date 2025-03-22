<?php

namespace Rahona\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Rahona\Models\Secret;

class SecretExpired
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Secret $secret
    ) {}
}
