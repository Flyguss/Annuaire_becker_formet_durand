<?php

namespace WebDirectory\app\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use WebDirectory\core\services\DepartementService;
use WebDirectory\core\services\PersonneService;

class GetListEntreAction extends AbstractAction
{
    private $personneService;
    private $departementService;

    public function __construct()
    {
        $this->personneService = new PersonneService();
        $this->departementService = new DepartementService();
    }

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $queryParams = $rq->getQueryParams();
        $selectedDepId = $queryParams['departement'] ?? null;

        if ($selectedDepId) {
            $entres = $this->personneService->getPersonnesByDepartement($selectedDepId);
        } else {
            $entres = $this->personneService->getAllPersonnes();
        }

        $departements = $this->departementService->getAllDepartements();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'TwigListEntre.twig', [
            'entres' => $entres,
            'departements' => $departements,
            'selectedDepId' => $selectedDepId,
        ]);
    }
}
