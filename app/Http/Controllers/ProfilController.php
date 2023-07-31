<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkRole:GESTION_BUDGET');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profils = Profil::all();
        $allRoles = Role::all();
        return view('profils.index', compact('profils', 'allRoles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', 'unique:profils', 'min:3'],
            'nom' => ['required', 'min:3'],
        ]);

        $profil = Profil::create($request->all());

        // Récupérer les IDs des rôles sélectionnés depuis le formulaire
        $rolesIds = $request->input('selectedRoles', []);

        // Mettre à jour la relation Many-to-Many (rôles associés) avec la méthode sync()
        $profil->roles()->sync($rolesIds);

        return redirect()->route('profils.index')->with('success', 'Le profil a été créé avec succès !');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profil $profil)
    {
        $request->validate([
            'code' => ['required', Rule::unique('profils')->ignore($profil->id), 'min:3'],
            'nom' => ['required', 'min:3'],
        ]);

        $profil->update($request->all());

        // Mettre à jour la relation Many-to-Many (rôles associés) avec la méthode sync()
        $rolesIds = $request->input('selectedRoles', []); // Récupérer les IDs des rôles soumis depuis le formulaire
        $profil->roles()->sync($rolesIds);

        return redirect()->route('profils.index')->with('success', 'Le profil a été modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profil $profil)
    {
        // Vérifier s'il y a des utilisateurs liés à ce profil
        $usersCount = $profil->users()->count();

        // Vérifier s'il y a des rôles liés à ce profil
        $rolesCount = $profil->roles()->count();

        if ($usersCount > 0 || $rolesCount > 0) {
            $errors = [];

            if ($usersCount > 0) 
                $errors['users'] = 'Impossible de supprimer le profil car des utilisateurs y sont liés.';

            if ($rolesCount > 0)
                $errors['roles'] = 'Impossible de supprimer le profil car des rôles y sont liés.';

            return redirect()->route('profils.index')->withErrors($errors);
        }
        
        $profil->delete();

        return redirect()->route('profils.index')->with('success', 'Le profil a été supprimé avec succès !');
    }
}
