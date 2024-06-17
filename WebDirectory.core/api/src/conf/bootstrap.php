<?php

// CrÃ©er une nouvelle application Slim
use Slim\Factory\AppFactory;
use WebDirectory\api\src\Infrastructure\Eloquent;


$app = AppFactory::create();

$app->addBodyParsingMiddleware();

// Ajouter les middlewares de routage et d'erreur
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);

(new Eloquent)->init(__DIR__ . '/config.ini');


// Inclure les routes
(require_once __DIR__ . '/routes.php')($app);

return $app ;