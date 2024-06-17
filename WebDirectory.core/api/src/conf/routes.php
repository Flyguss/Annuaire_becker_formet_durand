<?php
declare(strict_types=1);


use WebDirectory\api\src\Action\GetCategoriesAction;
use WebDirectory\api\src\Action\GetEntriesAction;
use WebDirectory\api\src\Action\GetEntriesByServiceAction;
use WebDirectory\api\src\Action\GetEntryDetailAction;
use WebDirectory\api\src\Action\SearchEntriesAction;

return function (\Slim\App $app) {

    $app->get('/api/services', GetCategoriesAction::class);
    $app->get('/api/entrees', GetEntriesAction::class);
    $app->get('/api/services/{id}/entrees', GetEntriesByServiceAction::class);
    $app->get('/api/entrees/search', SearchEntriesAction::class);
    $app->get('/api/entrees/{id}', GetEntryDetailAction::class);


    return $app;
};
