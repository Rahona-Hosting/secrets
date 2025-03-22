<?php

namespace Rahona\Http\Controllers\Web;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;

#[Middleware('auth')]
class HomeController
{
    #[Get('', name: 'home')]
    public function home()
    {
        return view('home');
    }
}
