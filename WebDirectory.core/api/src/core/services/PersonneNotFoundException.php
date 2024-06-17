<?php

namespace WebDirectory\api\src\core\services;

use PHPUnit\Framework\Exception;

class PersonneNotFoundException extends Exception
{
    protected $message = "Personne not found";
}