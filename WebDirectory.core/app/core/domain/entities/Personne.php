<?php

namespace WebDirectory\core\domain\entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use WebDirectory\app\core\domain\entites\Departement;

class Personne extends Model
{
    use HasUuids;
    protected $table='Personne';
    protected $primaryKey='id';
    public $timestamps=false ;
    public $keyType = 'string';

    public function departements(): BelongsToMany
    {
        return $this->belongsToMany(Departement::class, 'AppartientAuxDepartement', 'idPersonne', 'idDepartement');
    }
}