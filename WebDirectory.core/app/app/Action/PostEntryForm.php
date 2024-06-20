<?php
namespace WebDirectory\app\Action;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use WebDirectory\app\utils\CsrfService;
use WebDirectory\core\services\AnnuaireService;
use WebDirectory\core\services\AnnuaireServiceInterface;
use WebDirectory\core\services\PersonneNotFoundException;

class PostEntryForm extends AbstractAction
{
private string $templateValide;
private string $templateInvalide;
private AnnuaireServiceInterface $annuaireService;


public function __construct()
{
$this->templateValide = 'TwigEntryCreated.twig';
$this->templateInvalide = 'TwigCreateEntry.twig';
$this->annuaireService = new AnnuaireService();
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

$parsedBody = $rq->getParsedBody();
$uploadedFiles = $rq->getUploadedFiles();

if (!isset($parsedBody['csrf_token'])) {
throw new Exception('CSRF token missing');
}

try {
CsrfService::check($parsedBody['csrf_token']);
} catch (Exception $e) {
throw new Exception('CSRF validation failed: ' . $e->getMessage());
}

$nom = htmlspecialchars($parsedBody['nom'] ?? '');
$prenom = htmlspecialchars($parsedBody['prenom'] ?? '');
$email = htmlspecialchars($parsedBody['email'] ?? '');
$numTel = htmlspecialchars($parsedBody['telephone'] ?? '');
$numTelBureau = htmlspecialchars($parsedBody['telephoneBureau'] ?? '');
$fonction = htmlspecialchars($parsedBody['fonction'] ?? '');
$departementId = htmlspecialchars($parsedBody['departement'] ?? '');
$publie = isset($parsedBody['publie']) && $parsedBody['publie'] === 'true';

// Valider les données
if ($nom == null || $prenom == null || $email == null || $numTel == null || $fonction == null) {
$token = CsrfService::generate();
$data = [
'erreur' => "Veuillez remplir tous les champs obligatoires.",
'csrf_token' => $token
];
return $view->render($rs, $this->templateInvalide, $data);
}

// Gestion de l'image
$image = '';
if (isset($uploadedFiles['image'])) {
$imageFile = $uploadedFiles['image'];
if ($imageFile->getError() === UPLOAD_ERR_OK) {
$imageFileName = $imageFile->getClientFilename();
$imageFileName = pathinfo($imageFileName, PATHINFO_FILENAME);
$imageFileName = $imageFileName . '_' . time() . '.' . pathinfo($imageFile->getClientFilename(), PATHINFO_EXTENSION);
$imageFilePath = __DIR__ . '/../../../assets/image/' . $imageFileName;
$imageFile->moveTo($imageFilePath);
$image = $imageFileName;
}
}

// Créer l'entrée dans l'annuaire
try {
$this->annuaireService->createEntry($nom, $prenom, $email, $numTel, $numTelBureau, $fonction, $image, $departementId , $publie);
return $view->render($rs, $this->templateValide, ['nom' => $nom]);
} catch (PersonneNotFoundException $e) {
throw new Exception("Erreur lors de la création de l'entrée : " . $e->getMessage());
}
}

}
