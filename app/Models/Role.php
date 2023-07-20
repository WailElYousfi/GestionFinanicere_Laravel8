<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\Profil;

class Role extends Model
{
    use HasFactory;

    public function profils()
    {
        return $this->belongsToMany('App\Models\Profil');
    }
}
