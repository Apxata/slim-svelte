<?php

declare (strict_types=1);

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;

return function (ContainerInterface $container): App {
    $app = AppFactory::createFromContainer($container);
    $middleware = require __DIR__ . '/middleware.php';
    $middleware($app, $container);
    $routes = require __DIR__ . '/routes.php';
    $routes($app);

    return $app;
};