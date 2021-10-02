<?php
declare(strict_types=1);

use App\Controller\HomeController;
use DI\Container;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

//$container = new Container();
//
//$settings = require __DIR__ . '/../app/setting.php';
//$settings($container);

//$connection = require __DIR__ . '/../app/connection.php';
//$connection($container);

//$logger = require __DIR__ . '/../app/logger.php';
//$logger($container);

// Set Container on app
//AppFactory::setContainer($container);

// Create App
$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);
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