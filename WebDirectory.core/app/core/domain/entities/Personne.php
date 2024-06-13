<?php

namespace WebDirectory\core\domain\entities;

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

    public function prestations(): BelongsToMany
    {
        return $this->belongsToMany(::class, 'box2presta', 'box_id', 'presta_id')
            ->withPivot('quantite');
    }
}