<?php

namespace WebDirectory\app\src\core\services;

interface AnnuaireServiceInterface
{
    public function getDepartments();
    public function createEntry($nom, $prenom, $email, $numTel, $numTelBureau, $fonction, $image, $departementId);

}