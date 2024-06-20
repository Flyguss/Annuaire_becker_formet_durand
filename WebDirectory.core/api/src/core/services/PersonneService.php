<?php
namespace WebDirectory\api\src\core\services;

use WebDirectory\api\src\core\domain\entites\Personne;

class PersonneService
{
    public function getAllPersonnes()
    {
        return Personne::with('departements')
            ->where('publie', true)
            ->orderBy('nom')
            ->get();
    }

    public function getPersonnesByDepartement($departementId)
    {
        return Personne::whereHas('departements', function ($query) use ($departementId) {
            $query->where('id', $departementId);
        })->where('publie', true)->orderBy('nom')->get();
    }


    public function getPersonneById($personneId)
    {
        return Personne::with('departements')
            ->where('id', $personneId)
            ->where('publie', true)->first();
    }


    public function searchPersonnes($query)
    {
        return Personne::with('departements')
            ->where('Nom', 'like', '%' . $query . '%')
            ->where('publie', true)
            ->orderBy('nom')
            ->get();
    }

}
