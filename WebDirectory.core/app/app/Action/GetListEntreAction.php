<?php

namespace WebDirectory\app\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use WebDirectory\core\domain\entites\Departement;
use WebDirectory\core\domain\entites\Personne;

class GetListEntreAction extends AbstractAction
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $queryParams = $rq->getQueryParams();
        $selectedDepId = $queryParams['departement'] ?? null;

        if ($selectedDepId) {
            $entres = Personne::whereHas('departements', function ($query) use ($selectedDepId) {
                $query->where('id', $selectedDepId);
            })->orderBy('nom')->get();
        } else {
            $entres = Personne::with('departements')->orderBy('nom')->get();
        }

        $departements = Departement::all();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'TwigListEntre.twig', [
            'entres' => $entres,
            'departements' => $departements,
            'selectedDepId' => $selectedDepId,
        ]);
    }
}
