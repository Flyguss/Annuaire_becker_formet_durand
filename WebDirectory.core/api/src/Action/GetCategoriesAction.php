<?php

namespace WebDirectory\api\src\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDirectory\api\src\core\services\DepartementService;


class GetCategoriesAction
{
    private $departementService;

    public function __construct()
    {
        $this->departementService = new DepartementService();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $departements = $this->departementService->getAllDepartements();

        $data = [
            'type' => 'collection',
            'count' => count($departements),
            'departements' => $departements->map(function ($departement) {
                return [
                    'departement' => [
                        'id' => $departement->id,
                        'nom' => $departement->nom,
                        'description' => $departement->description,
                        'etagePrincipale' => $departement->etagePrincipale,
                    ],
                    'links' => [
                        'self' => ['href' => "/api/services/{$departement->id}/entrees"]
                    ]
                ];
            })
        ];

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
