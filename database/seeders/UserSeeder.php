<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profil;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profil = Profil::where('code', 'ADMIN')->first();

        User::create([
            'nom' => 'admin',
            'prenom' => 'admin',
            'email' => 'admin@gmail.com',
            'profil_id' => $profil->id,
            'password' => Hash::make('123')
        ]);
    }
}
