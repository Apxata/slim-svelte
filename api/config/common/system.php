<?php

declare (strict_types=1);

use Monolog\Logger;


if ($_ENV['APP_ENV'] === 'dev') {
    $debug = true;
    $level = Logger::DEBUG;
} else {
    $debug = false;
    $level = Logger::INFO;
}

return [
    'system' => [
        'debug' => $debug,
        'logger' =>
             [
                'name' => 'pitclub.bisapp.slim',
                'path' => __DIR__ . '/../../logs/app.log',
                'level' => $level,
            ],
        'connection' => [
            'host' => $_ENV['PDO_HOST'],
            'dbname' => $_ENV['PDO_DB_NAME'],
            'dbuser' => $_ENV['PDO_DB_USER'],
            'dbpass' => $_ENV['PDO_DB_PASS'],
        ]
     ]
];