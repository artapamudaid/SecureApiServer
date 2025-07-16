<?php

namespace Artapamudaid\SecureApiServer\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateApiKey
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-KEY');
        $signature = $request->header('X-API-SIGNATURE');
        $nonce = $request->header('X-NONCE');
        $timestamp = $request->header('X-TIMESTAMP');

        if (!$apiKey || !$signature || !$nonce || !$timestamp) {
            return response()->json(['error' => 'Unauthorized. Missing headers.'], 401);
        }

        return $next($request);
    }
}