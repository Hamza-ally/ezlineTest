<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class ApiAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        // Get the token from the request headers
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        // Remove 'Bearer ' prefix from the token
        $token = str_replace('Bearer ', '', $token);

        // Find the user by the api_token
        $user = User::where('api_token', $token)->first();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        // Log in the user
        // Auth::login($user);

        return $next($request);
    }
}
