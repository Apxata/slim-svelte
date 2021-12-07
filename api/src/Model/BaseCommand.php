<?php


namespace App\Model;


use App\Database\PDO2;
use PDO;
use Psr\Log\LoggerInterface;

class BaseCommand
{
    private PDO $conn;
    private PDO2 $conn2;
    protected LoggerInterface $logger;

    public function __construct(
        PDO $conn,
        PDO2 $conn2,
        LoggerInterface $logger
    )
    {
        $this->conn = $conn;
        $this->conn2 = $conn2;
        $this->logger = $logger;
    }
}