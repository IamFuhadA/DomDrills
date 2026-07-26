<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMembership
{
    /**
     * Ensure the authenticated user has an active membership.
     * Members without an active membership are redirected to the membership page.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Admins bypass membership check
        if ($user->hasRole('admin') || $user->hasRole('super-admin')) {
            return $next($request);
        }

        if (!$user->activeMembership()->exists()) {
            return redirect()->route('membership')
                             ->with('warning', 'You need an active membership to access this content.');
        }

        return $next($request);
    }
}
