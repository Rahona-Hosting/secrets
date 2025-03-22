<?php

namespace Rahona\Data;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;

class SecretAccessResource extends Data
{
    public string $ip;

    public string $user_agent;

    public bool $secret_viewed;

    public bool $password_incorrect;

    public Carbon $created_at;

    public Carbon $updated_at;
}
