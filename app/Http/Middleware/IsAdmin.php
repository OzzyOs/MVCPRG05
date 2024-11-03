<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Checks if the user is logged in and if it has an 'admin' role assigned, then return the next request.
        if (Auth::user() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'You do not have admin access.');
        // It will redirect the user back to the home screen if they do not have the role of 'admin' assigned in the database.
    }
}
