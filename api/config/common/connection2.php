<?php

declare(strict_types=1);

use App\Database\PDO2;
use Psr\Container\ContainerInterface;

return [
    PDO2::class => function (ContainerInterface $container) {

        $connection = $container->get('system')['connection_data'];
        $host = $connection['host'];
        $db_name = $connection['PDO_DB_PBC'];
        $db_user = $connection['dbuser'];
        $db_pass = $connection['dbpass'];
        $connect = [];
        try {
            $connect = new PDO2("mysql:host={$host};dbname={$db_name}", $db_user, $db_pass);
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $connect;
    }
];