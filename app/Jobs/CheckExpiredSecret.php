<?php

namespace Rahona\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Rahona\Events\SecretExpired;
use Rahona\Models\Secret;

class CheckExpiredSecret implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        Secret::query()
            ->where('expires_at', '<=', now())
            ->where('expiration_notified', false)
            ->where('data', '!=', null)
            ->whereDoesntHave('access', function ($query) {
                $query->where('secret_viewed', true);
            })
            ->chunk(100, function ($secrets) {
                foreach ($secrets as $secret) {
                    event(new SecretExpired($secret));
                }
            });
    }
}
