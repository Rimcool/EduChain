<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ApiKey;

class CheckApiKey
{
    public function handle(Request $request, Closure $next)
    {
        // Check for API key in headers
        $apiKey = $request->header('X-API-Key') ?? $request->query('api_key');
        
        if (!$apiKey) {
            return response()->json(['error' => 'API key required'], 401);
        }

        $key = ApiKey::where('key', $apiKey)->first();
        
        if (!$key || !$key->is_active) {
            return response()->json(['error' => 'Invalid API key'], 401);
        }

        // Check usage limits
        if ($key->usage_this_month >= $key->monthly_limit) {
            return response()->json(['error' => 'Monthly limit exceeded'], 429);
        }

        // Increment usage
        $key->increment('usage_this_month');
        
        // Attach user to request
        $request->merge(['api_user' => $key->user]);
        
        return $next($request);
    }
}