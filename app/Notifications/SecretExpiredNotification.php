<?php

namespace Rahona\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Rahona\Models\Secret;
use Rahona\Traits\NotificationPreference;

class SecretExpiredNotification extends Notification
{
    use NotificationPreference;
    use Queueable;

    protected Secret $secret;

    public function __construct(Secret $secret)
    {
        $this->secret = $secret;
    }

    public function via($notifiable): array
    {
        if ($this->shouldNotify($notifiable, 'notify_secret_expired')) {
            return ['mail'];
        }

        return [];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('emails.secret_expired.subject'))
            ->markdown('emails.secret-expired', [
                'secret' => $this->secret,
                'url' => route('user.secret', $this->secret),
                'expiresAt' => $this->secret->expires_at,
            ]);
    }
}
