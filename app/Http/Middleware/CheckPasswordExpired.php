<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPasswordExpired
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->mustChangePassword()) {
            if (!$request->routeIs('password.expired') && !$request->routeIs('password.expired.update')) {
                return redirect()->route('password.expired');
            }
        }

        return $next($request);
    }
}
