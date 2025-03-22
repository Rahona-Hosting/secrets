<?php

namespace Rahona\Data;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;

class SecretResource extends Data
{
    public function __construct(
        public int $id,
        public ?string $data,
        public string $url,
        public ?bool $isE2EE,
        public ?Carbon $expires_at,
        public ?int $max_views,
        public Carbon $created_at,
        public Carbon $updated_at,
        public ?array $access,
    ) {
        $this->url = route('public.secret', ['url' => $this->url]);
    }
}
