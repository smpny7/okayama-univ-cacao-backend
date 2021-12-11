<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomAccessToken
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader('X-Access-Token') && $request->header('X-Access-Token') == env('ACCESS_TOKEN'))
            return $next($request);
        else
            return response()->json(['success' => false, 'message' => 'Missing Access Token.'], 401);
    }
}
