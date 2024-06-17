<?php

namespace WebDirectory\core\services;

use WebDirectory\core\domain\entites\Personne;

class PersonneService
{
    public function getPersonnesByDepartement($departementId)
    {
        return Personne::whereHas('departements', function ($query) use ($departementId) {
            $query->where('id', $departementId);
        })->orderBy('nom')->get();
    }

    public function getAllPersonnes()
    {
        return Personne::with('departements')->orderBy('nom')->get();
    }
}
