<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDirectory\app\Action\GetAcceuil;

return function (\Slim\App $app) {

    $app->get('/hello/{name}',
        function(Request $rq, Response $rs, $args):Response{
            $name = $args['name'];
            $rs->getBody()->write("Hello, $name");
            return $rs;
        });
    $app->get('/', GetAcceuil::class)->setName('Acceuil');

    return $app;
};
