<?php

namespace App\Model\Consumables;

use App\Database\PDO2;
use PDO;
use Psr\Log\LoggerInterface;

class ConsumablesQuery
{
    private PDO $conn;
    private PDO2 $conn2;
    private LoggerInterface $logger;

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

    public function findNamesByName(string $name): array|bool
    {

        $pattern = '%' . $name . '%';
        $sql = 'SELECT id, name FROM consumables WHERE name LIKE :name ';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $pattern]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function findAllConsumables(): array
    {
        $sql = 'SELECT * FROM consumables ';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}