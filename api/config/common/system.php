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
    'config' => [
        'debug' => $debug,
        'logger' =>
             [
                'name' => 'pitclub.bisapp.slim',
                'path' => __DIR__ . '/../../logs/app.log',
                'level' => $level,
            ],
     ]
];