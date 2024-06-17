<?php

namespace WebDirectory\api\src\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDirectory\api\src\core\domain\entites\Departement;



class GetCategoriesAction extends AbstractAction{
    public function __invoke(Request $request, Response $response, array $args): Response {
        $departements = Departement::all();

        $data = [
            'type' => 'collection',
            'count' => count($departements),
            'departements' => $departements->map(function ($departement) {
                return [
                    'departement' => [
                        'id' => $departement->id,
                        'nom' => $departement->nom,
                        'description' => $departement->description,
                    ],
                    'links' => [
                        'self' => ['href' => "/api/services/{$departement->id}/entrées"]
                    ]
                ];
            })
        ];

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
