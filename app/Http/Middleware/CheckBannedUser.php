<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckBannedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
  public function handle(Request $request, Closure $next): Response
    {
        // Ila kan m-connecté w l-compte dyalo fih is_banned = true
        if (Auth::check() && Auth::user()->is_banned) {
            
            // Kan-khrjouh (Logout)
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Kan-reddouh l-page login m3a message d'erreur
            return redirect()->route('login')->withErrors([
                'email' => 'Votre compte a été suspendu par l\'administration.'
            ]);
        }

        return $next($request);
    }
}
