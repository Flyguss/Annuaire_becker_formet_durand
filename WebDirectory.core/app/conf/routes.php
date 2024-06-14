<?php
declare(strict_types=1);

use WebDirectory\app\Action\GetAcceuil;
use WebDirectory\app\Action\GetConnexionAction;
use WebDirectory\app\Action\GetCreerDepartementAction;
use WebDirectory\app\Action\GetDeconnexionAction;
use WebDirectory\app\Action\GetInscriptionAction;
use WebDirectory\app\Action\PostConnexionAction;
use WebDirectory\app\Action\PostCreerDepartementAction;
use WebDirectory\app\Action\PostInscriptionAction;

return function (\Slim\App $app) {

    $app->get('/', GetAcceuil::class)->setName('Acceuil');
    $app->get('/creerdepartement', GetCreerDepartementAction::class)->setName('CreerDepartement');
    $app->post('/creerdepartement', PostCreerDepartementAction::class);
    $app->get('/connexion', GetConnexionAction::class)->setName('Connexion');
    $app->post('/connexion' , PostConnexionAction::class)->setName('ConnexionPost');
    $app->get('/deconnexion', GetDeconnexionAction::class)->setName('Deconnexion');
    $app->get('/inscription', GetInscriptionAction::class)->setName('Inscription');
    $app->post('/inscription', PostInscriptionAction::class)->setName('InscriptionPost');

    return $app;
};
