<?php

namespace Rahona\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Laravel\Sanctum\PersonalAccessToken;
use Rahona\Traits\NotificationPreference;

class ApiTokenExpiringNotification extends Notification
{
    use NotificationPreference;

    public function __construct(
        protected PersonalAccessToken $token,
        protected int $daysUntilExpiration
    ) {}

    public function via($notifiable): array
    {
        if ($this->shouldNotify($notifiable, 'notify_api_token_expiring')) {
            return ['mail'];
        }

        return [];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('emails.token_expiring.subject'))
            ->markdown('emails.api-token-expiring', [
                'user' => $notifiable,
                'token' => $this->token,
                'daysUntilExpiration' => $this->daysUntilExpiration,
                'url' => url('/tokens'),
            ]);
    }

    public function toArray($notifiable): array
    {
        return [
            'token_id' => $this->token->id,
            'token_name' => $this->token->name,
            'days_until_expiration' => $this->daysUntilExpiration,
            'expires_at' => $this->token->expires_at,
        ];
    }
}
