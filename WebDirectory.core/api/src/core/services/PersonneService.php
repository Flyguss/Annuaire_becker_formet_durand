<?php

namespace WebDirectory\api\src\core\services;

use WebDirectory\api\src\core\domain\entites\Personne;

class PersonneService
{
    public function getAllPersonnes()
    {
        return Personne::with('departements')->orderBy('nom')->get();
    }

    public function getPersonnesByDepartement($departementId)
    {
        return Personne::whereHas('departements', function ($query) use ($departementId) {
            $query->where('id', $departementId);
        })->orderBy('nom')->get();
    }

    public function getPersonneById($personneId)
    {
        return Personne::with('departements')->find($personneId);
    }

    public function searchPersonnes($query)
    {
        return Personne::with('departements')->where('Nom', 'like', '%' . $query . '%')->orderBy('nom')->get();
    }
}
