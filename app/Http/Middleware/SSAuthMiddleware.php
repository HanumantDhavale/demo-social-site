<?php

namespace App\Http\Middleware;

use Closure;

class SSAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->ajax() && !auth()->check())
            return response()->json(['message' => 'For create post you need to login.'], 419);
        if (!auth()->check())
            return redirect()->route('auth.login');
        return $next($request);
    }
}
