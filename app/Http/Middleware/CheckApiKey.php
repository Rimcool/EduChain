<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ApiKey;

class CheckApiKey
{
    public function handle(Request $request, Closure $next): mixed
    {
        $key = $request->bearerToken()
            ?? $request->header('X-API-Key')
            ?? $request->get('api_key');

        if (!$key) {
            return response()->json(['error' => 'API key required'], 401);
        }

        $apiKey = ApiKey::where('key', $key)->where('is_active', true)->first();

        if (!$apiKey) {
            return response()->json(['error' => 'Invalid API key'], 401);
        }

        if ($apiKey->usage_this_month >= $apiKey->monthly_limit) {
            return response()->json(['error' => 'Monthly limit reached'], 429);
        }

        $apiKey->increment('usage_this_month');
        $apiKey->update(['last_used_at' => now()]);

        $request->merge(['api_key_user_id' => $apiKey->user_id]);
        return $next($request);
    }
}