<?php

namespace Rahona\Data;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Rahona\Models\Secret;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class SecretDetailResource extends Data
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
        #[DataCollectionOf(SecretAccessResource::class)]
        public Collection $access,
        public ?int $remaining_views,
        public bool $is_expired,
        public bool $is_viewable,
    ) {
        $this->url = route('public.secret', ['url' => $this->url]);
    }

    public static function fromModel(Secret $secret): self
    {
        return new self(
            id: $secret->id,
            data: $secret->data,
            url: $secret->url,
            isE2EE: $secret->isE2EE,
            expires_at: $secret->expires_at,
            max_views: $secret->max_views,
            created_at: $secret->created_at,
            updated_at: $secret->updated_at,
            access: SecretAccessResource::collect($secret->access),
            remaining_views: $secret->remainingViews(),
            is_expired: $secret->isExpired(),
            is_viewable: $secret->isViewable(),
        );
    }
}
