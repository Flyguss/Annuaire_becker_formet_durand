<?php

namespace WebDirectory\api\src\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use WebDirectory\api\src\core\domain\entites\Personne;


class GetEntryDetailAction extends AbstractAction {
    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $entryId = $args['id'];
        $entre = Personne::with('departements')->find($entryId);

        if (!$entre) {
            throw new HttpNotFoundException($rq, "Entrée non trouvée");
        }

        $data = [
            'type' => 'resource',
            'entre' => [
                'id' => $entre->id,
                'nom' => $entre->Nom,
                'prenom' => $entre->Prenom,
                'departements' => $entre->departements->map(function ($dep) {
                    return $dep->nom;
                })
            ]
        ];

        $rs->getBody()->write(json_encode($data));
        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
