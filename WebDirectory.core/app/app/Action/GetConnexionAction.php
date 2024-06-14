<?php

namespace WebDirectory\app\Action;




use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use WebDirectory\app\utils\CsrfService;

class GetConnexionAction extends AbstractAction {

    public function __invoke(Request $rq, Response $rs, array $args): Response{

        $view = Twig::fromRequest($rq);
        $token = CsrfService::generate() ;
        $data = [
            'token' => $token ,
        ];
        return $view->render($rs , 'TwigConnexion.twig' ,$data );

    }
}