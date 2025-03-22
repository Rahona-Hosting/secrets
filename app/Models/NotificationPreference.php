<?php

namespace Rahona\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'notify_api_token_expiring',
        'notify_secret_expired',
        'notify_secret_accessed',
    ];

    protected $casts = [
        'notify_api_token_expiring' => 'boolean',
        'notify_secret_expired' => 'boolean',
        'notify_secret_accessed' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
