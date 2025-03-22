<?php

namespace Rahona\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    protected $supportedLocales = ['fr', 'en', 'hu'];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = config('app.locale', 'fr');

        if (auth()->check() && auth()->user()->locale) {
            $locale = auth()->user()->locale;
        } elseif (session()->has('locale')) {
            $locale = session()->get('locale');
        }

        if (! in_array($locale, $this->supportedLocales)) {
            $locale = config('app.locale', 'fr');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
