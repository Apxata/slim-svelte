<?php

declare (strict_types=1);

use App\Controller\HomeController;
use App\Http\Action\HomeAction;
use Slim\App;

return function (App $app) {
    $app->get('/api/home', HomeController::class . ':home');
//    $app->get('/api/home', HomeAction::class);
};