<?php

namespace Rahona\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $socialite = $this->app->make(Factory::class);

        $socialite->extend('generic-sso', function ($app) use ($socialite) {
            $config = config('services.generic-sso');

            return $socialite->buildProvider(
                AuthentikProvider::class,
                $config
            );
        });
    }
}
