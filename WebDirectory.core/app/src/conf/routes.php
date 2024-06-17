<?php
declare(strict_types=1);


use WebDirectory\app\src\app\Action\GetAcceuil;
use WebDirectory\app\src\app\Action\GetConnexionAction;
use WebDirectory\app\src\app\Action\GetCreerDepartementAction;
use WebDirectory\app\src\app\Action\GetDeconnexionAction;
use WebDirectory\app\src\app\Action\GetEntryForm;
use WebDirectory\app\src\app\Action\GetInscriptionAction;
use WebDirectory\app\src\app\Action\GetListEntreAction;
use WebDirectory\app\src\app\Action\PostConnexionAction;
use WebDirectory\app\src\app\Action\PostCreerDepartementAction;
use WebDirectory\app\src\app\Action\PostEntryForm;
use WebDirectory\app\src\app\Action\PostInscriptionAction;

return function (\Slim\App $app) {

    $app->get('/', GetAcceuil::class)->setName('Acceuil');
    $app->get('/creerdepartement', GetCreerDepartementAction::class)->setName('CreerDepartement');
    $app->post('/creerdepartement', PostCreerDepartementAction::class);
    $app->get('/connexion', GetConnexionAction::class)->setName('Connexion');
    $app->post('/connexion' , PostConnexionAction::class)->setName('ConnexionPost');
    $app->get('/deconnexion', GetDeconnexionAction::class)->setName('Deconnexion');
    $app->get('/inscription', GetInscriptionAction::class)->setName('Inscription');
    $app->post('/inscription', PostInscriptionAction::class)->setName('InscriptionPost');
    $app->get('/list-entre', GetListEntreAction::class)->setName('ListeEntre');
    $app->get('/entry/create', GetEntryForm::class)->setName('CreateEntry');
    $app->post('/entry/create', PostEntryForm::class)->setName('PostCreateEntry');

    return $app;
};
