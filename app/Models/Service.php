<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
     protected $primaryKey = 'id_service';

    protected $fillable = [
        'nom'
    ];


    public function employees()
    {
        return $this->hasMany(Employee::class, 'service_id', 'id_service');
    }
}
