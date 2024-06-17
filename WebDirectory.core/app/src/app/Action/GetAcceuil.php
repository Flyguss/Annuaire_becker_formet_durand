<?php

namespace WebDirectory\app\src\app\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetAcceuil extends AbstractAction {

    public function __invoke(Request $rq, Response $rs, array $args): Response{

        $view = Twig::fromRequest($rq);
        return $view->render($rs , 'TwigAcceuil.twig' );

    }
}