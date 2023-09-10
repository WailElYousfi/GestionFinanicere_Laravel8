<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleBudget = Role::create([
            'code' => 'GESTION_BUDGET',
            'nom' => 'Gestion budgétaire',
            'description' => 'Gérer les budgets'
        ]);
        $roleAchat = Role::create([
            'code' => 'GESTION_ACHAT',
            'nom' => 'Gestion des achats',
            'description' => 'Gérer les achats'
        ]);
        $roleTresorie = Role::create([
            'code' => 'GESTION_TRESORERIE',
            'nom' => 'Gestion de trésorerie',
            'description' => 'Gérer les liquidités dans l\'entreprise'
        ]);
        $roleProjet = Role::create([
            'code' => 'GESTION_PROJET',
            'nom' => 'Gestion des projet',
            'description' => 'Gérer les projets'
        ]);
        $roleUtilisateur = Role::create([
            'code' => 'GESTION_UTILISATEURS',
            'nom' => 'Gestion des utilisateurs',
            'description' => 'Ajouter, modifier ou supprimer des utilisateurs'
        ]);
        $roleProfil = Role::create([
            'code' => 'GESTION_PROFILS',
            'nom' => 'Gestion des profils',
            'description' => 'Ajouter, modifier ou supprimer des utilisateurs'
        ]);

        
    }
}
