<?php

namespace WebDirectory\app\src\app\Action;



use AllowDynamicProperties;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use WebDirectory\app\src\app\utils\CsrfService;
use WebDirectory\app\src\core\services\AuthentificationService;
use WebDirectory\app\src\core\services\AuthentificationServiceInterface;


class PostInscriptionAction extends AbstractAction {

    private string $templateValide;
    private string $templateInvalide;
    private AuthentificationServiceInterface $catalogue ;

    public function __construct() {
        $this->templateValide = 'TwigPostInscription.twig' ;
        $this->templateInvalide = 'TwigInscription.twig' ;
        $this->catalogue = new AuthentificationService();
    }

    public function __invoke(Request $rq, Response $rs, array $args): Response{

        $view = Twig::fromRequest($rq);

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
        $password = password_hash( htmlspecialchars($parsedBody['password'] ?? '') , PASSWORD_BCRYPT);
        if (! filter_var($email , FILTER_VALIDATE_EMAIL)){
            $token = CsrfService::generate();
            $data = [
                'erreur' => 'Email ou Mot de passe incorrect !',
                'token' => $token
            ];
            return $view->render($rs , $this->templateInvalide , $data);
        }


        $this->catalogue->addUser($email , $password);

        $_SESSION['email'] = $email;

        return $view->render($rs , $this->templateValide );
    }
}