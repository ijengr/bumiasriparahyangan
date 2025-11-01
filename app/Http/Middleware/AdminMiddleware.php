<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     * Allow only authenticated users with role 'admin' or 'editor' to access admin routes.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (! $user || ! in_array($user->role ?? null, ['admin', 'editor'])) {
            // If the user is not authorized, redirect to login
            return redirect()->route('login');
        }

        return $next($request);
    }
}
