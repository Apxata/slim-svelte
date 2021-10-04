<?php

declare (strict_types=1);

use DI\ContainerBuilder;

$builder = new ContainerBuilder();
if($_ENV['APP_ENV'] === 'prod') {
    $builder->enableCompilation(dirname(__DIR__) . '/var/cache');
}

$builder->addDefinitions(require __DIR__ . '/dependencies.php');

return $builder->build();