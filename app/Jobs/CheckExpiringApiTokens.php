<?php

namespace Rahona\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Laravel\Sanctum\PersonalAccessToken;
use Rahona\Models\User;
use Rahona\Notifications\ApiTokenExpiringNotification;

class CheckExpiringApiTokens implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct() {}

    public function handle(): void
    {
        $warningDate = Carbon::now()->addDays(7);

        $expiringTokens = PersonalAccessToken::query()
            ->whereNotNull('expires_at')
            ->where('expires_at', '>', Carbon::now())
            ->where('expires_at', '<=', $warningDate)
            ->where('expiration_notified', false)
            ->get();

        foreach ($expiringTokens as $token) {
            $user = $token->tokenable;

            if ($user instanceof User && $user->wantsNotification('notify_api_token_expiring')) {
                $user->notify(new ApiTokenExpiringNotification(
                    token: $token,
                    daysUntilExpiration: (int) Carbon::now()->diffInDays($token->expires_at)
                ));

                $token->forceFill(['expiration_notified' => true])->save();
            }
        }
    }
}
