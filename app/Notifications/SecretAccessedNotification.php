<?php

namespace Rahona\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Rahona\Models\Secret;
use Rahona\Models\SecretAccess;
use Rahona\Traits\NotificationPreference;

class SecretAccessedNotification extends Notification
{
    use NotificationPreference;
    use Queueable;

    protected Secret $secret;

    protected string $ipAddress;

    public function __construct(SecretAccess $access)
    {
        $this->secret = $access->secret;
        $this->ipAddress = $access->ip;
    }

    public function via($notifiable): array
    {
        if ($this->shouldNotify($notifiable, 'notify_secret_accessed')) {
            return ['mail'];
        }

        return [];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('emails.secret_accessed.subject'))
            ->markdown('emails.secret-accessed', [
                'secret' => $this->secret,
                'ipAddress' => $this->ipAddress,
                'remainingViews' => $this->secret->remainingViews(),
                'expiresAt' => $this->secret->expires_at,
                'url' => route('user.secret', $this->secret),
            ]);
    }
}
