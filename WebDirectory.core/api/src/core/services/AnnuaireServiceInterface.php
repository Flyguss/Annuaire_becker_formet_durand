<?php

namespace WebDirectory\api\src\core\services;

interface AnnuaireServiceInterface
{
    public function getDepartments();
    public function createEntry($nom, $prenom, $email, $numTel, $numTelBureau, $fonction, $image);

}