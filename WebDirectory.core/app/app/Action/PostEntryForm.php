<?php
namespace WebDirectory\app\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use WebDirectory\core\services\AnnuaireService;
use WebDirectory\core\services\AnnuaireServiceInterface;
use WebDirectory\core\services\PersonneNotFoundException;


class PostEntryForm
{
    private AnnuaireServiceInterface $annuaireService;

    public function __construct() {
        $this->annuaireService = new AnnuaireService();
    }

    public function __invoke(Request $rq, Response $rs, array $args): Response {
        $data = $rq->getParsedBody();

        try {
            $nom = $data['Nom'] ?? '';
            $prenom = $data['Prenom'] ?? '';
            $email = $data['email'] ?? '';
            $numTel = $data['NuméroTelephone'] ?? '';
            $numTelBureau = $data['NuméroTelephoneBureau'] ?? '';
            $fonction = $data['Fonction'] ?? '';
            $image = $data['image'] ?? '';

            if ($this->annuaireService->createEntry($nom, $prenom, $email, $numTel, $numTelBureau, $fonction, $image)) {
                $rs->getBody()->write("Nouvelle entrée créée avec succès.");
            } else {
                $rs->getBody()->write("Erreur lors de la création de l'entrée.");
            }
        } catch (PersonneNotFoundException $e) {
            throw new HttpNotFoundException($rq, $e->getMessage());
        }

        return $rs;
    }
}
