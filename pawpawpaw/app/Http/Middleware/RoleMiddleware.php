<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized', 'user' => Auth::user()], 401);
        }

        $user = Auth::user();

        // Check if the authenticated user's role matches the required role

        // Check if the user's role matches any of the required roles
        if (count($roles) !== 0 &&  !in_array($user->role, $roles)) {
            return response()->json([
                'message' => 'Forbidden',
                'error' => 'You do not have access to this resource',
            ], 403);
        }

        // Allow the request to proceed
        return $next($request);
    }
}
