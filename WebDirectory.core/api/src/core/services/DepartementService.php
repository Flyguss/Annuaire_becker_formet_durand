<?php

namespace WebDirectory\api\src\core\services;

use WebDirectory\api\src\core\domain\entites\Departement;

class DepartementService
{
    public function getAllDepartements()
    {
        return Departement::all();
    }
}
