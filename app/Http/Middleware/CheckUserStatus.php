<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // Vérifier si un utilisateur est connecté
        if (auth()->check()) {
            $user = auth()->user();

            // Vérifier le statut de l'utilisateur dans la table "user_info"
            if ($user->information->status == 0) {
                // Utilisateur inactif, refuser la connexion
                auth()->logout();
                return redirect()->route('login')->withError("Votre compte est désactivé. Veuillez contacter l'administrateur.");
            }
        }

        return $next($request);
    }
}
