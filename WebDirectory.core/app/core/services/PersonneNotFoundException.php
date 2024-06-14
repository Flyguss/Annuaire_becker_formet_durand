<?php

namespace WebDirectory\core\services;

use http\Message;
use PHPUnit\Framework\Exception;

class PersonneNotFoundException extends Exception
{
    protected $message = "Personne not found";
}