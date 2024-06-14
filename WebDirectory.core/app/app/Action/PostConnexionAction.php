<?php

namespace WebDirectory\app\Action;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use WebDirectory\app\Action\AbstractAction;
use WebDirectory\app\utils\CsrfService;
use WebDirectory\core\services\AuthentificationService;
use WebDirectory\core\services\AuthentificationServiceInterface;
use WebDirectory\core\services\UserNotFoundException;

class PostConnexionAction extends AbstractAction
{

    private string $templateValide;
    private string $templateInvalide;
    private AuthentificationServiceInterface $authentificationService;

    public function __construct()
    {
        $this->templateValide = 'TwigPostConnexion.twig';
        $this->templateInvalide = 'TwigConnexion.twig';
        $this->authentificationService = new AuthentificationService();
    }

    /**
     * @throws SyntaxError
     * @throws UserNotFoundException
     * @throws RuntimeError
     * @throws LoaderError
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

        $email = htmlspecialchars($parsedBody['name'] ?? '');
        $password = $parsedBody['password'] ?? '';


        $user = $this->authentificationService->getUserByEmail($email);
        if ($user == null || !$this->authentificationService->verifyPassword($password, $user)) {
            $token = CsrfService::generate();
            $data = [
                'erreur' => 'Email ou Mot de passe incorrect !',
                'token' => $token
            ];

            return $view->render($rs, $this->templateInvalide, $data);
        }

        // Mettre l'email en session
        $_SESSION['email'] = $email;

        return $view->render($rs, $this->templateValide);
    }
}


