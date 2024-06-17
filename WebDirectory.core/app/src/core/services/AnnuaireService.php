<?php

namespace WebDirectory\app\src\core\services;



use WebDirectory\app\src\core\domain\entites\Departement;
use WebDirectory\app\src\core\domain\entites\Personne;

class AnnuaireService implements AnnuaireServiceInterface
{


    public function getDepartments()
    {
        return Departement::all()->toArray();
    }

    public function createEntry($nom, $prenom, $email, $numTel, $numTelBureau, $fonction, $image ,$departementId) {
        $personne = new Personne();
        $personne->Nom = $nom;
        $personne->Prenom = $prenom;
        $personne->email = $email;
        $personne->NuméroTelephone = $numTel;
        $personne->NuméroTelephoneBureau = $numTelBureau;
        $personne->Fonction = $fonction;
        $personne->image = $image;
        $personne->save();

        $departement = Departement::find($departementId);
        if ($departement) {
            $personne->departements()->attach($departementId);
        }

        return $personne;
    }
}