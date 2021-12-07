<?php

declare (strict_types=1);

use App\Controller\Access\LoginController;
use App\Controller\Access\RegisterController;
use App\Controller\HomeController;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app) {

    $app->group('/api', function (RouteCollectorProxy $group) {

        $group->get('/home', HomeController::class . ':home');
        $group->post('/login', LoginController::class . ':login');
        $group->post('/register', RegisterController::class . ':register');

        $group->get('/date', function (Request $request, Response $response) {
            $response->getBody()->write(date('Y-m-d H:i:s'));
            return $response;
        });

        $group->get('/time', function (Request $request, Response $response) {
            $response->getBody()->write((string)time());
            return $response;
        });

//        $group->group('/story', function (RouteCollectorProxy $group) {
//            $group->get('/date', function (Request $request, Response $response) {
//                $response->getBody()->write(date('Y-m-d H:i:s'));
//                return $response;
//            });
//        });
    });

};