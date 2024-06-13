<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDirectory\app\Action\GetAcceuil;

return function (\Slim\App $app) {

    $app->get('/', GetAcceuil::class)->setName('Acceuil');

    return $app;
};
