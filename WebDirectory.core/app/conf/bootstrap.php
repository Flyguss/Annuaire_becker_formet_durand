<?php

// Créer une nouvelle application Slim
use gift\appli\Infrastructure\Eloquent;
use Slim\Factory\AppFactory;

$app = AppFactory::create();



$app->setBasePath('/gift/gift.appli/public');

$twig = \Slim\Views\Twig::create(__DIR__ .'\..\app\view',
    ['auto_reload' => true]);

$app->add(
    \Slim\Views\TwigMiddleware::create($app, $twig)) ;

$app->addBodyParsingMiddleware();

$twig->getEnvironment()
    ->addGlobal('session' , $_SESSION);

// Ajouter les middlewares de routage et d'erreur
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);

(new Eloquent)->init(__DIR__ . '/config.ini');


// Inclure les routes
(require_once __DIR__ . '/routes.php')($app);

return $app ;
