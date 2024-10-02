<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckApiAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        dd('hi');
        // Check if the user is authenticated
        if (auth()->user()) {
            // User is authenticated, proceed with the request
            return $next($request);
        }

        // User is not authenticated, return an error response
        return response()->json(['error' => 'Unauthenticated.'], 401);
    }
}
