<?php

namespace WebDirectory\api\src\core\domain\entites;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Personne extends Model
{

    protected $table='Personne';

    public $timestamps=false ;

    public function departements(): BelongsToMany
    {
        return $this->belongsToMany(Departement::class, 'AppartientAuxDepartement', 'idPersonne', 'idDepartement');
    }
}