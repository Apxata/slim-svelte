<?php

use Psr\Container\ContainerInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

return
    [
        Environment::class => function (ContainerInterface $c) {
            $loader = new FilesystemLoader(__DIR__ . '/../../templates');
            $twig = new Environment($loader, [
                __DIR__ . '/../../var/cache/twig'
            ]);
            if ($_ENV['APP_ENV'] === 'dev') {
                $twig->enableDebug();
            }

            return $twig;
        }
];