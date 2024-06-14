<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use WebDirectory\app\Action\GetAcceuil;
use WebDirectory\app\Action\GetCreerDepartementAction;
use WebDirectory\app\Action\GetEntryForm;
use WebDirectory\app\Action\PostEntryForm;

return function (\Slim\App $app) {

    $app->get('/', GetAcceuil::class)->setName('Acceuil');
    $app->get('/creerdepartement', GetCreerDepartementAction::class)->setName('CreerDepartement');
    $app->get('/entry/create', GetEntryForm::class)->setName('createEntryForm');
    $app->post('/entry/create', PostEntryForm::class)->setName('processEntryForm');

    return $app;
};
