<?php
declare(strict_types=1);

use WebDirectory\app\Action\GetAcceuil;
use WebDirectory\app\Action\GetConnexionAction;
use WebDirectory\app\Action\GetCreerDepartementAction;
use WebDirectory\app\Action\GetEntryForm;
use WebDirectory\app\Action\PostEntryForm;
use WebDirectory\app\Action\GetDeconnexionAction;
use WebDirectory\app\Action\GetInscriptionAction;
use WebDirectory\app\Action\PostConnexionAction;
use WebDirectory\app\Action\PostCreerDepartementAction;
use WebDirectory\app\Action\PostInscriptionAction;
use WebDirectory\app\Action\GetListEntreAction;

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
    $app->get('/entry/create', GetEntryForm::class)->setName('createEntryForm');
    $app->post('/entry/create', PostEntryForm::class)->setName('processEntryForm');

    return $app;
};
