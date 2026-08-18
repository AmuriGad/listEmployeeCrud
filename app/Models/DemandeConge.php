<?php

namespace App\Models;

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
        'date_fin'   => 'date',
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
            'accepte'   => 'Accepté',
            'refuse'    => 'Refusé',
            default     => 'En attente',
        };
    }

    /**
     * Classes CSS du badge selon le statut.
     */
    public function statutBadgeClass(): string
    {
        return match ($this->statut) {
            'accepte'   => 'bg-green-50 border border-green-200 text-green-700',
            'refuse'    => 'bg-red-50 border border-red-200 text-red-700',
            default     => 'bg-yellow-50 border border-yellow-200 text-yellow-700',
        };
    }
}

