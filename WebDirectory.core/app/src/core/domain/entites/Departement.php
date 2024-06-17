<?php

namespace WebDirectory\app\src\core\domain\entites;


use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{

    protected $table='Département';

    public $timestamps=false ;

    public function personnes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Personne::class, 'AppartientAuxDepartement', 'idDepartement', 'idPersonne');
    }

}

