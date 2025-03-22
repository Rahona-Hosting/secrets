<?php

namespace Rahona\Helpers;

class SSOProviders
{
    public static function getEnabledSocialiteProviders(): array
    {
        $providers = [];

        if (config('services.generic-sso.client_id')) {
            $providers['generic-sso'] = [
                'name' => config('services.sso-label.name'),
                'icon' => config('services.sso-label.icon'),
                'classes' => config('services.sso-label.classes'),
            ];
        }

        if (config('services.github.client_id')) {
            $providers['github'] = [
                'name' => 'GitHub',
                'icon' => 'fab fa-github',
                'classes' => 'bg-gray-800 hover:bg-gray-700 text-white',
            ];
        }

        if (config('services.google.client_id')) {
            $providers['google'] = [
                'name' => 'Google',
                'icon' => 'fab fa-google',
                'classes' => 'bg-white hover:bg-gray-100 text-gray-800',
            ];
        }

        if (config('services.authentik.client_id')) {
            $providers['authentik'] = [
                'name' => config('services.sso-label.name'),
                'icon' => config('services.sso-label.icon'),
                'classes' => config('services.sso-label.classes'),
            ];
        }

        if (config('services.discord.client_id')) {
            $providers['discord'] = [
                'name' => 'Discord',
                'icon' => 'fab fa-discord',
                'classes' => 'discord-color bg-opacity-5 hover:bg-opacity-10 text-white border border-blue-800',
            ];
        }

        return $providers;
    }
}
