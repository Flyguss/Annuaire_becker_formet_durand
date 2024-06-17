<?php

namespace WebDirectory\api\src\core\services;

use WebDirectory\src\core\domain\entites\Departement;
use WebDirectory\src\core\domain\entites\Personne;

class AnnuaireService implements AnnuaireServiceInterface
{


    public function getDepartments()
    {
        return Departement::all();
    }

    public function createEntry($nom, $prenom, $email, $numTel, $numTelBureau, $fonction, $image) {
        $personne = new Personne();
        $personne->Nom = $nom;
        $personne->Prenom = $prenom;
        $personne->email = $email;
        $personne->NuméroTelephone = $numTel;
        $personne->NuméroTelephoneBureau = $numTelBureau;
        $personne->Fonction = $fonction;
        $personne->image = $image;
        $personne->save();
    }
}