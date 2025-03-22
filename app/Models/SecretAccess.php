<?php

namespace Rahona\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SecretAccess extends Model
{
    protected $fillable = [
        'secret_id',
        'ip',
        'user_agent',
        'password_incorrect',
        'password_correct',
        'secret_viewed',
    ];

    public function secret(): BelongsTo
    {
        return $this->belongsTo(Secret::class);
    }
}
