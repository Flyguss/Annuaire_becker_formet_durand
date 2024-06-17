<?php

namespace WebDirectory\api\src\core\services;

class UserNotFoundException extends \Exception
{
    protected $message = 'User not found';
}