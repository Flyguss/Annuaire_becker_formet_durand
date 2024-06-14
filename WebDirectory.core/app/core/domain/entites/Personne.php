<?php

namespace WebDirectory\core\domain\entites;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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