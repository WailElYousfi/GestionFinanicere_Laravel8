<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profil;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profilAdmin = Profil::where('code', 'ADMIN')->first();

        User::create([
            'nom' => 'EL HAOUAT',
            'prenom' => 'Ahmed',
            'email' => 'ahmed@gmail.com',
            'profil_id' => $profilAdmin->id,
            'password' => Hash::make('12345678')
        ]);

        $profilFinancier = Profil::where('code', 'FINANCIER')->first();

        User::create([
            'nom' => 'john',
            'prenom' => 'snow',
            'email' => 'john@gmail.com',
            'profil_id' => $profilFinancier->id,
            'password' => Hash::make('12345678')
        ]);
    }
}
