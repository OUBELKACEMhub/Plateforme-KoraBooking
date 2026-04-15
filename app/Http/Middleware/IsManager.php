<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsManager
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && strtolower(Auth::user()->role) === 'manager') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Accès refusé. Cette section est réservée aux managers.');
        
    }
}
