<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Ensure the authenticated user has the required role.
     *
     * Usage: Route::middleware('role:admin')
     *        Route::middleware('role:admin,super-admin')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Check using Spatie Permission (when installed) or role column
        foreach ($roles as $role) {
            if (method_exists($user, 'hasRole') && $user->hasRole($role)) {
                return $next($request);
            }

            // Fallback: role column on users table
            if (isset($user->role) && $user->role === $role) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized. You do not have the required role to access this area.');
    }
}
