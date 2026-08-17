<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'service_id',
        'nom',
        'prenom',
        'postnom',
        'email',
        'telephone',
        'poste',
        'departement',
        'date_embauche',
        'password'
    ];

    protected $casts = [
        'date_embauche' => 'date',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id_service');
    }

    public function demandeConges()
    {
        return $this->hasMany(DemandeConge::class, 'employee_id', 'id');
    }
}

