<?php

namespace WebDirectory\core\domain\entites;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table='User';
    public $timestamps=false ;

}

