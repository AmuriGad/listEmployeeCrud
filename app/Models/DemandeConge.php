<?php

namespace App\Models;

use App\StatutConge;
use Illuminate\Database\Eloquent\Model;

class DemandeConge extends Model
{
    protected $primaryKey = 'id_demande';

    protected $fillable = [
        'employee_id',
        'type_conge_id',
        'date_debut',
        'date_fin',
        'statut'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'statut' => StatutConge::class,
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function typeConge()
    {
        return $this->belongsTo(TypeConge::class, 'type_conge_id', 'id_type_conge');
    }
}

