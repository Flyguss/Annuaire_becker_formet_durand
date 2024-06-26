<?php

namespace WebDirectory\app\Action;

use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use WebDirectory\app\utils\CsrfService;
use WebDirectory\core\services\AnnuaireService;
use WebDirectory\core\services\AnnuaireServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDirectory\core\services\DepartementNotFoundException;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GetEntryForm
{
    private string $template;
    private AnnuaireServiceInterface $annuaireService;

    public function __construct() {
        $this->template = 'TwigCreateEntry.twig';
        $this->annuaireService = new AnnuaireService();
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        try {
            $departments = $this->annuaireService->getDepartments();
        } catch (DepartementNotFoundException $e) {
            throw new HttpNotFoundException($rq, $e->getMessage());
        }

        $token = CsrfService::generate();
        $data = [
            'departments' => $departments,
            'csrf_token' => $token
        ];


        $view = Twig::fromRequest($rq);
        return $view->render($rs, $this->template, $data);
    }

}