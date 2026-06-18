<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $auth = $request->header('Authorization');
        if (! $auth || ! preg_match('/Bearer\s+(.*)$/i', $auth, $matches)) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        $token = $matches[1];
        try {
            $secret = env('JWT_SECRET', 'change-me');
            $decoded = JWT::decode($token, new Key($secret, 'HS256'));

            $user = User::where('id_user', $decoded->sub)->first();
            if (! $user) {
                return response()->json(['error' => 'User not found'], 401);
            }

            // Login the user for the request lifecycle
            Auth::loginUsingId($user->id_user);

            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid token', 'message' => $e->getMessage()], 401);
        }
    }
}
