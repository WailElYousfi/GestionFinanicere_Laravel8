<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Profil;

class CheckRole
{
    public function handle(Request $request, Closure $next, $roleCode)
    {
        if (!Auth::check()) {
            // L'utilisateur n'est pas authentifié, redirection vers la page de connexion par exemple.
            return redirect('/login');
        }

        // Obtenez le profil de l'utilisateur connecté
        $profil = Auth::user()->profil;

        // Vérifiez si le profil de l'utilisateur a le rôle spécifique
        if (!$this->hasRole($profil, $roleCode)) {
            // L'utilisateur n'a pas le rôle nécessaire, redirection vers une page d'erreur ou autre.
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }

    // Méthode pour vérifier si le profil a un rôle spécifique
    private function hasRole($profil, $roleCode)
    {
        return $profil->roles->contains('code', $roleCode);
    }
}
