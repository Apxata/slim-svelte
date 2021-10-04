<?php

declare(strict_types=1);

use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;

return [
    LoggerInterface::class => function (ContainerInterface $container) {
        $settings = $container->get('config')['logger'];

        $logger = new Logger($settings['name']);

        $processor = new UidProcessor();
        $logger->pushProcessor($processor);

        $handler = new StreamHandler($settings['path'], $settings['level']);
        $logger->pushHandler($handler);

        return $logger;
    }
];