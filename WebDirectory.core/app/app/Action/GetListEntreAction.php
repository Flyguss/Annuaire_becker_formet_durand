<?php

namespace WebDirectory\app\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetListEntreAction extends AbstractAction
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $create = '2024-05-14 13:28:00';

        $boxes = Personne::all();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'TwigListBox.twig', ['boxes' => $boxes]);
    }
}