<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckApproved
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (Auth::user()->status === 'pending') {
            return redirect()->route('pending');
        }
        if (Auth::user()->status === 'suspended') {
            Auth::logout();
            return redirect()->route('login')
                ->with('error', 'Your account has been suspended.');
        }
        return $next($request);
    }
}