<?php

namespace WebDirectory\app\src\app\Action;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use WebDirectory\app\src\app\utils\CsrfService;


class GetCreerDepartementAction extends AbstractAction {

    public function __invoke(Request $rq, Response $rs, array $args): Response{

        $view = Twig::fromRequest($rq);
        $data = [
            'token' => CsrfService::generate()
        ];
        return $view->render($rs , 'TwigCreerDepartement.twig' , $data);

    }
}