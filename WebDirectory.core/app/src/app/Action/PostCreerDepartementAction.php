<?php

namespace WebDirectory\app\src\app\Action;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use WebDirectory\app\src\app\utils\CsrfService;
use WebDirectory\app\src\core\services\DepartementService;
use WebDirectory\app\src\core\services\DepartementServiceInterface;


class PostCreerDepartementAction extends AbstractAction
{

    private string $templateValide;
    private string $templateInvalide;
    private DepartementServiceInterface $departementService;

    public function __construct()
    {
        $this->templateValide = 'TwigPostCreerDepartement.twig';
        $this->templateInvalide = 'TwigCreerDépartment.twig';
        $this->departementService = new DepartementService();
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     * @throws Exception
     */
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $view = Twig::fromRequest($rq);

        // Récupérer et valider les données du formulaire
        $parsedBody = $rq->getParsedBody();

        if (!isset($parsedBody['csrf_token'])) {
            throw new Exception('CSRF token missing');
        }

        try {
            CsrfService::check($parsedBody['csrf_token']);
        } catch (Exception $e) {
            throw new Exception('CSRF validation failed: ' . $e->getMessage());
        }

        $name = htmlspecialchars($parsedBody['name'] ?? '');
        $etage = htmlspecialchars($parsedBody['etage'] ?? '');
        $desc = htmlspecialchars($parsedBody['descp'] ?? '');


        if ($name == null || $etage == null || $desc == null) {
            $token = CsrfService::generate();
            $data = [
                'erreur' => "Veuillez remplir les 3 champs le nom, l'étage et la desciption",
                'token' => $token
            ];

            return $view->render($rs, $this->templateInvalide, $data);
        }

        $this->departementService->addDepartement($name , $etage , $desc);


        return $view->render($rs, $this->templateValide , ['name' => $name]);
    }
}


