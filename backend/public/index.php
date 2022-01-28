<?php
declare(strict_types=1);

use Psr\Container\ContainerInterface;

http_response_code(500);

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../config/loader.php';

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
 /** @var  ContainerInterface $container */
$container = require __DIR__ . '/../config/container.php';
// Create App
$app = (require __DIR__ .'/../config/app.php')($container);
//var_dump($appFactory);
//die();
//$app = $appFactory($container);
//$app = AppFactory::create();


//$views = require __DIR__ . '/../app/views.php';
//$views($app);
//
//$middleware = require __DIR__ . '/../app/middleware.php';
//$middleware($app);
//$middleware = require __DIR__ . '/../config/middleware.php';
//$middleware($app, $container);
//$routes = require __DIR__ . '/../config/routes.php';
//$routes($app);

// Run App
$app->run();