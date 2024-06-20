<?php

namespace WebDirectory\api\src\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use WebDirectory\api\src\core\services\PersonneService;


class GetEntryDetailAction
{
    private $personneService;

    public function __construct()
    {
        $this->personneService = new PersonneService();
    }

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $entryId = $args['id'];
        $entre = $this->personneService->getPersonneById($entryId);

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
                }),
                'NuméroTelephone' => $entre->NuméroTelephone,
                'NuméroTelephoneBureau' => $entre->NuméroTelephoneBureau,
                'Fonction' => $entre->Fonction,
                'email' => $entre->email,
                'img' => $entre->image
            ]
        ];

        $rs->getBody()->write(json_encode($data));
        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
