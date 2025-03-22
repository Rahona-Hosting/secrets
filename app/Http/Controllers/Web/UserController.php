<?php

namespace Rahona\Http\Controllers\Web;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Rahona\Models\Secret;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;

#[Middleware('auth')]
class UserController
{
    #[Get('profile', name: 'user.profile')]
    public function profile()
    {
        return view('user.profile', [
            'user' => Auth::user(),
        ]);
    }

    #[Get('secrets/{secret}', name: 'user.secret')]
    public function showSecret(Secret $secret)
    {
        if ($secret->user_id !== Auth::id()) {
            abort(403);
        }

        $remainingTime = null;
        if ($secret->expires_at) {
            $remainingTime = now()->diff($secret->expires_at);
        }

        $accesses = $secret->access()
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = [
            'total_attempts' => $accesses->count(),
            'last_attempt' => $accesses->first()?->created_at,
            'successful_views' => $accesses->where('secret_viewed', true)->count(),
        ];

        return view('user.secret', compact('secret', 'remainingTime', 'accesses', 'stats'));
    }

    #[Get('apis', 'user.apis')]
    public function apis()
    {
        return view('user.apis', [
            'user' => Auth::user(),
        ]);
    }

    #[Get('enable-two-factor', name: 'user.enableTwoFactor', middleware: 'password.confirm')]
    public function enableTwoFactor(EnableTwoFactorAuthentication $enable)
    {
        $enable(Auth::user());

        return redirect()->route('user.profile');
    }

    #[Get('logoutOtherBrowserSessions', name: 'user.logoutOtherBrowserSessions', middleware: 'password.confirm')]
    public function logoutOtherBrowserSessions()
    {
        DB::table('sessions')
            ->where('user_id', auth()->user()->getAuthIdentifier())
            ->where('id', '!=', session()->getId())
            ->delete();

        auth()->user()->forceFill([
            'remember_token' => null,
        ])->save();

        return to_route('user.profile');
    }
}
