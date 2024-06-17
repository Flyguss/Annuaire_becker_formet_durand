<?php

namespace WebDirectory\api\src\core\services;

interface AuthentificationServiceInterface {

    public function addUser($email , $password);

    public function getUserByEmail($email);
}
