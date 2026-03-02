<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Don't forget to import Auth

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect('/login'); // Or abort(401) for API routes
        }

        // Get the authenticated user
        $user = Auth::user();

        // Check if the user has any of the required roles
        foreach ($roles as $role) {
            if ($user->role === $role) {
                return $next($request);
            }
        }

        // If no matching role is found, deny access
        // For web routes:
        abort(403, 'Unauthorized action. You do not have the required role.');

        // For API routes (uncomment if you have a dedicated API for this):
        // return response()->json(['message' => 'Unauthorized'], 403);
    }
}