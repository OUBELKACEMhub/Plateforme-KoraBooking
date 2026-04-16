<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class IsCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    if (Auth::check() && strtolower(Auth::user()->role) === 'customer') {
        return $next($request);
    }

    if (Auth::check() && strtolower(Auth::user()->role) === 'manager') {
        return redirect()->route('manager.dashboard');
    }

    return redirect('/');
}
}
