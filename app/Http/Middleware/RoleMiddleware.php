<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle($request, Closure $next, $role, $permission = null)
    {
        // Check if the user is authenticated using the 'admin' guard
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();

            // Check if the user has the specified role
            if ($user->hasRole($role)) {
                // If a permission is provided, check if the user has that permission
                if ($permission && !$user->can($permission)) {
                    abort(403, 'Unauthorized action.');
                }

                // Proceed to the next request if role and permission checks pass
                return $next($request);
            }
        }

        // Abort with 403 if the user does not meet the role/permission requirements
        abort(403, 'Unauthorized action.');
    }
}
