<?php

namespace Rahona\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Secret extends Model
{
    use HasFactory;

    protected $fillable = [
        'data',
        'max_views',
        'expires_at',
    ];

    protected $casts = [
        'data' => 'encrypted',
        'expires_at' => 'datetime',
        'isE2EE' => 'boolean',
        'expiration_notified' => 'boolean',
        'access_notified' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->url = self::generateUniqueUrl();
        });
    }

    private static function generateUniqueUrl(): string
    {
        do {
            $url = Str::random(8);
        } while (self::where('url', $url)->exists());

        return $url;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function access(): HasMany
    {
        return $this->hasMany(SecretAccess::class);
    }

    public function isExpired(): bool
    {
        return $this->expires_at?->isPast() ?? false;
    }

    public function isViewable(): bool
    {
        if ($this->data === null) {
            return false;
        }

        if ($this->expires_at && $this->isExpired()) {
            return false;
        }

        if ($this->max_views !== null) {
            $viewCount = $this->access()
                ->where('secret_viewed', true)
                ->count();

            return $viewCount < $this->max_views;
        }

        return true;
    }

    public function remainingViews(): ?int
    {
        if ($this->max_views === null) {
            return null;
        }

        $viewCount = $this->access()
            ->where('secret_viewed', true)
            ->count();

        return max(0, $this->max_views - $viewCount);
    }
}
