<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;

return [
    PDO::class => function (ContainerInterface $container) {

        $connection = $container->get('system')['connection_data'];
        $host = $connection['host'];
        $dbname = $connection['dbname'];
        $dbuser = $connection['dbuser'];
        $dbpass = $connection['dbpass'];
        $connect = [];
        try {
            $connect = new PDO("mysql:host={$host};dbname={$dbname}", $dbuser, $dbpass);
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $connect;
    }
];