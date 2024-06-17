<?php

namespace WebDirectory\api\src\core\services;

use PHPUnit\Framework\Exception;

class DepartementNotFoundException extends Exception
{
    protected $message = "Département not found";
}