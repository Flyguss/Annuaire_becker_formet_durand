<?php

namespace WebDirectory\app\src\core\services;

class UserNotFoundException extends \Exception
{
    protected $message = 'User not found';
}