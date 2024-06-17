<?php

namespace WebDirectory\api\src\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDirectory\api\src\core\domain\entites\Personne;


class GetEntriesByServiceAction extends AbstractAction {
    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $serviceId = $args['id'];
        $entres = Personne::whereHas('departements', function ($query) use ($serviceId) {
            $query->where('id', $serviceId);
        })->orderBy('nom')->get();

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
