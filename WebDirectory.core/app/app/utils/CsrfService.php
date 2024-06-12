<?php

namespace gift\appli\app\utils;

use Exception;
use function PHPUnit\Framework\equalTo;

class CsrfService {
    public static function generate(): string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    /**
     * @throws Exception
     */
    public static function check(string $token): bool {

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token)) {

        unset($_SESSION['csrf_token']);
        return true;
    }

    throw new Exception('Token csrf invalide');
}
}
