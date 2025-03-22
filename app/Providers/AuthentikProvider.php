<?php

namespace Rahona\Providers;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class AuthentikProvider extends AbstractProvider implements ProviderInterface
{
    protected $scopeSeparator = ' ';

    protected $scopes = ['openid', 'profile', 'email'];

    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase(config('services.generic-sso.auth_endpoint'), $state);
    }

    protected function getTokenUrl()
    {
        return config('services.generic-sso.token_endpoint');
    }

    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get(config('services.generic-sso.userinfo_endpoint'), [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id' => $user['sub'] ?? null,
            'name' => $user['name'] ?? null,
            'email' => $user['email'] ?? null,
            'avatar' => $user['picture'] ?? null,
        ]);
    }
}
