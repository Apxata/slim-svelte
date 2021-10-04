<?php

declare (strict_types=1);

use Dotenv\Dotenv;

include_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();

if ($_ENV['APP_ENV'] === 'DEV') {
    $debug = true;
} else {
    $debug = false;
}

return [
    'config' => [
        'debug' => $debug
    ],
];