<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkRole:GESTION_UTILISATEURS');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $profils = Profil::all();
        return view('users.index', compact('users', 'profils'));
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
            'nom' => ['required', 'string', 'max:255', 'min:2'],
            'prenom' => ['required', 'string', 'max:255', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $user = User::create([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'email' => $request->input('email'),
            'profil_id' => $request->input('profil'),
            'password' => Hash::make($request->input('password'),),
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur ajouté avec succès !');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)]
        ]);

        // Mettre à jour les champs
        $user->nom = $request['nom'];
        $user->prenom = $request['prenom'];
        $user->email = $request['email'];
        $user->profil_id = $request['profil'];
        $user->save();

        return redirect()->route('users.index')->with('success', 'Utilisateur modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Récupérer l'utilisateur à supprimer
        $user = User::findOrFail($user->id);

        // Vérifier si l'utilisateur à supprimer est l'utilisateur connecté
        if ($user->id === Auth::user()->id) {
            return redirect()->route('users.index')->with('error', "Vous ne pouvez pas supprimer votre propre compte.");
        }

        // Supprimer l'utilisateur
        $user->delete();

        // Rediriger vers la page de liste des utilisateurs
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès !');
    }
}
