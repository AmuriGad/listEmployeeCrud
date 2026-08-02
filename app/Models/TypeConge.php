<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeConge extends Model
{
    protected $primaryKey = 'id_type_conge';

    protected $fillable = [
        'libelle',
        'description'
    ];

    public function demandeConges()
    {
        return $this->hasMany(DemandeConge::class, 'type_conge_id', 'id_type_conge');
    }
}

