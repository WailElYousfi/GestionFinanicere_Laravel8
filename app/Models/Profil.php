<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\Role;

class Profil extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'code', 'nom'
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }
}
