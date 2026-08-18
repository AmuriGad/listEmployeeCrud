<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsDRH
{
    /**
     * Autorise l'accès uniquement aux employés avec le poste "DRH".
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || !Auth::user()->isDRH()) {
            // Redirige les non-DRH vers leur propre dashboard
            return redirect()->route('employe.dashboard')
                ->with('error', 'Accès refusé. Cette section est réservée au DRH.');
        }

        return $next($request);
    }
}
