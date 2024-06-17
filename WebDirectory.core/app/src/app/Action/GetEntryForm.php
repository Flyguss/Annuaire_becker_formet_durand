<?php

namespace WebDirectory\app\src\app\Action;

use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use WebDirectory\app\src\app\utils\CsrfService;
use WebDirectory\app\src\core\services\AnnuaireService;
use WebDirectory\app\src\core\services\AnnuaireServiceInterface;
use WebDirectory\app\src\core\services\DepartementNotFoundException;

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