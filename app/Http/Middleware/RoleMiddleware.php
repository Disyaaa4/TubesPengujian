<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Usage: ->middleware([\App\Http\Middleware\RoleMiddleware::class . ':admin,kaprodi'])
     */
    public function handle(Request $request, Closure $next, $roles = null)
    {
        $user = Auth::user();
        if (! $user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        if (! $roles) {
            return $next($request);
        }

        $allowed = array_map('trim', explode(',', $roles));
        $userRole = strtolower($user->role);

        $allowedLower = array_map('strtolower', $allowed);
        if (! in_array($userRole, $allowedLower)) {
            return response()->json(['error' => 'Forbidden, insufficient role'], 403);
        }

        return $next($request);
    }
}
