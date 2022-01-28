<?php

declare (strict_types=1);

use App\Controller\Access\LoginController;
use App\Controller\Access\RegisterController;
use App\Controller\Consumables\ConsumablesController;
use App\Controller\HomeController;
use App\Middleware\Auth\AuthMiddleware;
use App\Middleware\Auth\RedirectFromLoginPageMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app) {


    $app->get('/home', HomeController::class . ':home');
    $app->post('/auth-status', LoginController::class . ':auth_status');
    $app->post('/is_authorized', LoginController::class . ':authorized');
    $app->post('/login_q', LoginController::class . ':login_q');

    $app->group('/v1', function (RouteCollectorProxy $group) {
            $group->post('/login_q', LoginController::class . ':login_q');
            $group->get('/home', HomeController::class . ':home');
            $group->get('/profile', HomeController::class . ':home');
            $group->post('/register', RegisterController::class . ':register');
            $group->post('/register_simple', RegisterController::class . ':register_simple');
            $group->get('/date', function (Request $request, Response $response) {
                $response->getBody()->write(date('Y-m-d H:i:s'));
                return $response;
            });

            $cons_route = require_once( __DIR__ . '/routes/consumables.php');
            $cons_route($group);

            $group->get('/time', function (Request $request, Response $response) {
                $response->getBody()->write((string)time());
                return $response;
            });

            $group->group('/story', function (RouteCollectorProxy $group) {
                $group->get('/date', function (Request $request, Response $response) {
                    $response->getBody()->write(date('Y-m-d H:i:s'));
                    return $response;
                });
            });
        });
    };