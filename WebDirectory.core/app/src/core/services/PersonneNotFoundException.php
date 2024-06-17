<?php

namespace WebDirectory\app\src\core\services;

use http\Message;
use PHPUnit\Framework\Exception;

class PersonneNotFoundException extends Exception
{
    protected $message = "Personne not found";
}