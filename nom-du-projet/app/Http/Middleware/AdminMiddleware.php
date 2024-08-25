<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Vérifiez si l'utilisateur est authentifié et est un administrateur
         if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Si l'utilisateur n'est pas un administrateur, retourner une réponse 403 (Interdit)
        return response()->json(['message' => 'Access denied. Only admins can access this route.'], 403);
    }
}
