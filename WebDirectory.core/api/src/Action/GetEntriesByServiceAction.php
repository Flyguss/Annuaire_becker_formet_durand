<?php

namespace WebDirectory\api\src\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDirectory\api\src\core\services\PersonneService;


class GetEntriesByServiceAction
{
    private $personneService;

    public function __construct()
    {
        $this->personneService = new PersonneService();
    }

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $serviceId = $args['id'];
        $entres = $this->personneService->getPersonnesByDepartement($serviceId);

        $data = [
            'type' => 'collection',
            'count' => count($entres),
            'entres' => $entres->map(function ($entre) {
                return [
                    'nom' => $entre->Nom,
                    'prenom' => $entre->Prenom,
                    'departements' => $entre->departements->map(function ($dep) {
                        return $dep->nom;
                    }),
                    'links' => [
                        'self' => ['href' => '/api/entrees/' . $entre->id]
                    ]
                ];
            })
        ];

        $rs->getBody()->write(json_encode($data));
        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
