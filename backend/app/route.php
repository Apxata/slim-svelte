<?php

declare(strict_types=1);

use App\Controller\HomeController;
use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

//    $app->group('/api', function (RouteCollectorProxy $group) {
//        $group->get('/date', function (Request $request, Response $response) {
//            $response->getBody()->write(date('Y-m-d H:i:s'));
//            return $response;
//        });
//        $group->get('/date',HomeController::class . ':date');

//        $group->get('/time', function (Request $request, Response $response) {
//            $response->getBody()->write((string)time());
//            return $response;
//        });
//    });

//    $app->get('/admin', function (RequestInterface $request, ResponseInterface $response, $args) {
//        $response->getBody()->write("Hello World");
//        return $response;
//    });
//
    $app->get('/api/home', HomeController::class . ':home');
    $app->get('/api/date',HomeController::class . ':date');
//
//    $app->get('/user/{name}', function (RequestInterface $request, ResponseInterface $response, $args)
//    {
//        $name = $args['name'];
//        $response->getBody()->write("Hello, $name");
//        return $response;
//    });
//
//    $container = $app->getContainer();
//
//    $app->group('', function (RouteCollectorProxy $view)
//    {
//        $view->get('/example/{name}', function($request, $response, $args) {
//            $name = $args['name'];
//
//            return $this->get('view')->render($response, 'example.twig', compact('name'));
//        });
//
//        $view->get('/views/{name}', function ($request, $response, $args) {
//            $view = 'example.twig';
//            $name = $args['name'];
//
//            return $this->get('view')->render($response, $view, compact('name'));
//        });
//
//    })->add($container->get('viewMiddleware'));
};