<?php

namespace WebDirectory\app\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use WebDirectory\core\domain\entities\Personne;

class GetListEntreAction extends AbstractAction
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {

        $entre = Personne::all();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'TwigListEntre.twig', ['entre' => $entre]);
    }
}