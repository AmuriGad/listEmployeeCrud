<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'postnom',
        'email',
        'telephone',
        'poste',
        'departement',
        'date_embauche'
    ];


    protected $casts = [
        'date_embauche' => 'date',
    ];
}