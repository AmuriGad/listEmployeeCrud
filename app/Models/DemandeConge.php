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

    /**
     * Libellé lisible du statut.
     */
    public function statutLabel(): string
    {
        return match ($this->statut) {
            StatutConge::ACCEPTE => 'Accepté',
            StatutConge::REFUSE  => 'Refusé',
            default              => 'En attente',
        };
    }

    /**
     * Classes CSS du badge selon le statut.
     */
    public function statutBadgeClass(): string
    {
        return match ($this->statut) {
            StatutConge::ACCEPTE => 'bg-green-100 text-green-800',
            StatutConge::REFUSE  => 'bg-red-100 text-red-800',
            default              => 'bg-yellow-100 text-yellow-800',
        };
    }
}

