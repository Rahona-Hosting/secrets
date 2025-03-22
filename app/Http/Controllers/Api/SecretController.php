<?php

namespace Rahona\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Rahona\Data\SecretDetailResource;
use Rahona\Data\SecretResource;
use Rahona\Http\Controllers\Controller;
use Rahona\Models\Secret;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('secrets')]
class SecretController extends Controller
{
    #[Get('/')]
    public function index(Request $request): JsonResponse
    {
        $secrets = Secret::query()
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(100);

        return response()->json(SecretResource::collect($secrets));
    }

    #[Get('/{secret}')]
    public function show(Request $request, Secret $secret): JsonResponse
    {
        if ($secret->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json(SecretDetailResource::from($secret->load('access')));
    }

    #[Post('/')]
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'data' => 'required|string',
            'max_views' => 'integer|min:1',
            'expires_at' => 'nullable|date|after:now',
            'isE2EE' => 'nullable|boolean',
        ]);

        $secret = new Secret($validated);
        $secret->user_id = $request->user()->id;
        $secret->save();

        return response()->json([
            'message' => 'Secret created successfully',
            'secret' => SecretDetailResource::from($secret),
        ], 201);
    }

    #[Delete('/{secret}')]
    public function destroy(Request $request, Secret $secret): JsonResponse
    {
        if ($secret->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $secret->delete();

        return response()->json([
            'message' => 'Secret deleted successfully',
        ]);
    }
}
