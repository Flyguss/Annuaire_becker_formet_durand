<?php

namespace WebDirectory\core\services;

class AnnuaireService implements AnnuaireServiceInterface
{


    public function getDepartments()
    {
        return Departement::all();
    }

    public function createEntry(array $data)
    {
        $personne = Personne::create([
            'Nom' => $data['nom'],
            'Prenom' => $data['prenom'],
            'email' => $data['email'],
            'NuméroTelephone' => $data['telephone'],
            'NuméroTelephoneBureau' => $data['telephoneBureau'],
            'Fonction' => $data['fonction']
        ]);

        if ($personne) {
            $personne->departements()->attach($data['departement']);
            return true;
        }

        return false;
    }
}