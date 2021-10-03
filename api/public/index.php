<?php

declare(strict_types=1);

use App\Controller\HomeController;
use DI\Container;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

http_response_code(500);

require __DIR__ . '/../vendor/autoload.php';

//$container = new Container();
//
//$settings = require __DIR__ . '/../app/setting.php';
//$settings($container);
$builder = new ContainerBuilder();
$builder->addDefinitions([
    'config' => [
        'debug' => true
    ]
]);
$container = $builder->build();
//$connection = require __DIR__ . '/../app/connection.php';
//$connection($container);

//$logger = require __DIR__ . '/../app/logger.php';
//$logger($container);

// Set Container on app
//AppFactory::setContainer($container);

// Create App
$app = AppFactory::createFromContainer($container);
//$app = AppFactory::create();
$app->addErrorMiddleware($container->get('config')['debug'], true, true);
$app->get('/api/home', HomeController::class . ':home');
//$views = require __DIR__ . '/../app/views.php';
//$views($app);
//
//$middleware = require __DIR__ . '/../app/middleware.php';
//$middleware($app);

//$routes = require __DIR__ . '/../app/route.php';
//$routes($app);

// Run App
$app->run();