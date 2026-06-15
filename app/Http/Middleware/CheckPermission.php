<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        if (!auth()->check()) {
            abort(403, 'No autenticado');
        }

        $user = auth()->user();

        foreach ($permissions as $permission) {
            if (str_contains($permission, '|')) {
                $orPermissions = explode('|', $permission);
                foreach ($orPermissions as $orPerm) {
                    if ($user->hasPermission(trim($orPerm))) {
                        return $next($request);
                    }
                }
            } elseif (str_ends_with($permission, '.*')) {
                $prefix = substr($permission, 0, -2);
                if ($user->hasPermissionWildcard($prefix)) {
                    return $next($request);
                }
            } elseif ($user->hasPermission($permission)) {
                return $next($request);
            }
        }

        abort(403, 'No tienes permiso para realizar esta acción.');
    }
}
