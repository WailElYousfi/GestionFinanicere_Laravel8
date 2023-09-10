<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profil;
use App\Models\Role;

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allRoles = Role::all();

        $admin = Profil::create([
            'code' => 'ADMIN',
            'nom' => 'Adminstrateur'
        ]);
        $admin->roles()->sync($allRoles);

        //////////////////////////////////////////////

        $rolesBudgetEtAchat = Role::whereIn('code', ['GESTION_BUDGET', 'GESTION_ACHAT'])->get();

        $financier = Profil::create([
            'code' => 'FINANCIER',
            'nom' => 'Financier'
        ]);
        $financier->roles()->sync($rolesBudgetEtAchat);

        //////////////////////////////////////////////

        Profil::create([
            'code' => 'COMPTABLE',
            'nom' => 'Comptable'
        ]);
    }
}
