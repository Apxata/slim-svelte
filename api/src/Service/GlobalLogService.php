<?php
declare(strict_types=1);

namespace App\Service;


use PDO;

class GlobalLogService
{
    private PDO $conn;


    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function writeLog()
    {

    }

}