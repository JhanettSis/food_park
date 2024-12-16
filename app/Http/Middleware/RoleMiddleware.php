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
    public function handle(Request $request, Closure $next, $role): Response
    {
         // Check if the user is authenticated and has the required role
        if (Auth::check() && $request->user()->role === $role) {
            return $next($request); // Proceed if the user has the correct role
        }

        // Redirect to 'home' if the role does not match
        return to_route('dashboard');
    }
}
