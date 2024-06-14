<?php

namespace WebDirectory\core\services ;

interface AuthentificationServiceInterface {

    public function addUser($email , $password);

    public function getUserByEmail($email);
}
