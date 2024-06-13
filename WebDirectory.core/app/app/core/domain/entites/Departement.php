<?php

namespace WebDirectory\app\core\domain\entites;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Departement extends Model
{
    use HasUuids;
    protected $table='box';
    protected $primaryKey='id';
    public $timestamps=false ;
    public $keyType = 'int';



}

