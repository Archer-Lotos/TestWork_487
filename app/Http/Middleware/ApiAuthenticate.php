<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;

class ApiAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        $key = $request->query('key');

        if (empty($key)) {
            $key = $request->input('key');
        }

        if (!empty($key)) {
            if (ApiKey::where('key', '=', $key)->first()->exists()){
                return $next($request);
            } else {
                response()->json(['message' => 'Wrong key'], 401);
            }
        }

        return response()->json(['message' => 'API key not found'], 401);
    }
}
