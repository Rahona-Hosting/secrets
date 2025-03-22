<?php

namespace Rahona\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Rahona\Http\Controllers\Controller;
use Rahona\Models\User;
use Spatie\RouteAttributes\Attributes\Get;

class UserController extends Controller
{
    #[Get('me')]
    public function me(): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ]);
    }
}
