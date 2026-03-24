<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckApproved
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        
        // Allow super admins to bypass approval check
        if ($user->role === 'super_admin') {
            return $next($request);
        }
        
        // Check if user is approved
        if ($user->status === 'approved') {
            return $next($request);
        }

        // If not approved, redirect to pending page
        return redirect('/pending')->with('message', 'Your account is pending approval. Please wait for admin approval.');
    }
}