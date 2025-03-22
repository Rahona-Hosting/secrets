<?php

namespace Rahona\Http\Controllers\Web;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Rahona\Http\Controllers\Controller;
use Rahona\Models\User;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('auth')]
class SocialiteController extends Controller
{
    #[Get('{provider}/redirect', name: 'socialite.redirect')]
    public function redirect(string $provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    #[Get('{provider}/callback', name: 'socialite.callback')]
    public function callback(string $provider): RedirectResponse
    {
        try {
            $socialiteUser = Socialite::driver($provider)->user();

            $email = $socialiteUser->getEmail();

            $query = User::query();

            if ($email) {
                $query->where('email', $email)
                    ->orWhere(function ($q) use ($provider, $socialiteUser) {
                        $q->where('auth_provider', $provider)
                            ->where('provider_id', $socialiteUser->getId());
                    });
            } else {
                $query->where('auth_provider', $provider)
                    ->where('provider_id', $socialiteUser->getId());
            }

            $user = $query->first();

            if (! $user) {
                $userData = [
                    'name' => $socialiteUser->getName(),
                    'auth_provider' => $provider,
                    'provider_id' => $socialiteUser->getId(),
                    'provider_data' => [
                        'avatar' => $socialiteUser->getAvatar(),
                        'token' => $socialiteUser->token,
                        'refresh_token' => $socialiteUser->refreshToken ?? null,
                    ],
                ];

                if ($email) {
                    $userData['email'] = $email;
                }

                $user = User::create($userData);
            } else {
                $updateData = [
                    'auth_provider' => $provider,
                    'provider_id' => $socialiteUser->getId(),
                    'provider_data' => [
                        'avatar' => $socialiteUser->getAvatar(),
                        'token' => $socialiteUser->token,
                        'refresh_token' => $socialiteUser->refreshToken ?? null,
                        'nickname' => $socialiteUser->getNickname(),
                    ],
                ];

                if ($email && ! $user->email) {
                    $updateData['email'] = $email;
                }

                $user->update($updateData);
            }

            Auth::login($user);

            return redirect()->intended(route('home'));

        } catch (Exception $e) {
            // todo sentry
            return redirect()->route('login')
                ->withErrors(['error' => 'Une erreur est survenue lors de la connexion.']);
        }
    }
}
