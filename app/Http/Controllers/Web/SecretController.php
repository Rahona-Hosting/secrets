<?php

namespace Rahona\Http\Controllers\Web;

use Illuminate\Http\Request;
use Rahona\Http\Controllers\Controller;
use Rahona\Models\Secret;
use Rahona\Models\SecretAccess;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('s')]
class SecretController extends Controller
{
    #[Get('{url}', name: 'public.secret')]
    public function show(string $url, Request $request)
    {
        $secret = Secret::where('url', $url)->first();

        if (! $secret) {
            return view('secrets.error', [
                'title' => 'Secret introuvable',
                'message' => 'Ce secret n\'existe pas ou a déjà été détruit.',
                'type' => 'not_found',
            ]);
        }

        SecretAccess::create([
            'secret_id' => $secret->id,
            'ip' => $request->getClientIp(),
            'user_agent' => $request->userAgent(),
        ]);

        if ($secret->expires_at && $secret->isExpired()) {
            $secret->data = null;
            $secret->save();

            return view('secrets.error', [
                'title' => 'Secret expiré',
                'message' => 'Ce secret a expiré et a été détruit.',
                'type' => 'expired',
                'expiredAt' => $secret->expires_at,
            ]);
        }

        if (! $secret->isViewable()) {
            return view('secrets.error', [
                'title' => 'Secret plus disponible',
                'message' => 'Ce secret a atteint son nombre maximum de consultations.',
                'type' => 'max_views',
            ]);
        }

        return view('secrets.show', [
            'secret' => $secret,
            'isE2EE' => $secret->isE2EE,
        ]);
    }
}
