<?php

namespace Rahona\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Rahona\Observers\UserObserver;

#[ObservedBy(UserObserver::class)]
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'auth_provider',
        'provider_id',
        'provider_data',
        'locale',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
        'provider_data',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_local' => 'boolean',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'provider_data' => 'array',
            'two_factor_recovery_codes_downloaded' => 'boolean',
        ];
    }

    public function secrets(): HasMany
    {
        return $this->hasMany(Secret::class);
    }

    public function isSsoUser(): bool
    {
        return ! $this->is_local;
    }

    public function getProviderData(string $key, $default = null): mixed
    {
        return data_get($this->provider_data, $key, $default);
    }

    public function notificationPreference(): HasOne
    {
        return $this->hasOne(NotificationPreference::class);
    }

    public function wantsNotification(string $type): bool
    {
        return $this->notificationPreference?->{$type} ?? true;
    }
}
