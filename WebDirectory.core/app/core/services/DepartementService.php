<?php

namespace WebDirectory\core\services;

use WebDirectory\core\domain\entites\Departement;

class DepartementService implements DepartementServiceInterface{

    public function addDepartement($name, $etage, $description){

        $departement = new Departement ;
        $departement->nom = $name ;
        $departement->etagePrincipale = $etage ;
        $departement->description = $description ;
        $departement->save();

    }
    public function getAllDepartements()
    {
        return Departement::all();
    }
}