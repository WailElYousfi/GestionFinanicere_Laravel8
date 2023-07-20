<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Middleware\CheckRole;

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
        $profils = Profil::latest()->paginate(5);
        return view('profils.index', compact('profils'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allRoles = Role::all();
        return view('profils.create', compact('allRoles'));
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
            'code' => ['required', 'unique:profils'],
            'nom' => 'required',
        ]);
  
        $profil = Profil::create($request->all());
   
        // Récupérer les IDs des rôles sélectionnés depuis le formulaire
        $rolesIds = $request->input('selectedRoles', []);

        // Mettre à jour la relation Many-to-Many (rôles associés) avec la méthode sync()
        $profil->roles()->sync($rolesIds);

        return redirect()->route('profils.index')->with('success','Profil created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function show(Profil $profil)
    {
        return view('profils.show', compact('profil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function edit(Profil $profil)
    {
        $allRoles = Role::all(); // Supposons que vous avez un modèle Role pour les rôles
        return view('profils.edit',compact('profil', 'allRoles'));
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
            'code' => ['required', Rule::unique('profils')->ignore($profil->id)],
            'nom' => 'required',
        ]);
  
        $profil->update($request->all());

        // Mettre à jour la relation Many-to-Many (rôles associés) avec la méthode sync()
        $rolesIds = $request->input('selectedRoles', []); // Récupérer les IDs des rôles soumis depuis le formulaire
        $profil->roles()->sync($rolesIds);

        return redirect()->route('profils.index')->with('success','Profil updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profil $profil)
    {
        $profil->delete();
  
        return redirect()->route('profils.index')->with('success','Profil deleted successfully');
    }
}