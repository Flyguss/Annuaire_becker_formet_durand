<?php

// CrÃ©er une nouvelle application Slim
use Slim\Factory\AppFactory;
use WebDirectory\api\src\Infrastructure\Eloquent;


$app = AppFactory::create();

$app->addBodyParsingMiddleware();

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

//CORS
$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

(new Eloquent)->init(__DIR__ . '/config.ini');

// Inclure les routes
(require_once __DIR__ . '/routes.php')($app);

return $app ;