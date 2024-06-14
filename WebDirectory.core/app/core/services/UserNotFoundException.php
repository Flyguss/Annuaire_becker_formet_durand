<?php

namespace WebDirectory\core\services;

class UserNotFoundException extends \Exception
{
    protected $message = 'User not found';
}