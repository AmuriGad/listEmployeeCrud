<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Employee extends Authenticatable
{
    use Notifiable;

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
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'date_embauche' => 'date',
        'password'      => 'hashed',
    ];

    /**
     * Vérifie si l'employé est DRH (administrateur).
     */
    public function isDRH(): bool
    {
        return $this->poste === 'DRH';
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id_service');
    }

    public function demandeConges()
    {
        return $this->hasMany(DemandeConge::class, 'employee_id', 'id');
    }
}
