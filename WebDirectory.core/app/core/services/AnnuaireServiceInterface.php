<?php

namespace WebDirectory\core\services;

interface AnnuaireServiceInterface
{
    public function getDepartments();
    public function createEntry($nom, $prenom, $email, $numTel, $numTelBureau, $fonction, $image, $departementId);

}