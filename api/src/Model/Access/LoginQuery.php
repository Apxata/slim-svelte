<?php


namespace App\Model\Access;


use App\Database\PDO2;
use PDO;
use Psr\Log\LoggerInterface;

class LoginQuery
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

    public function getByEmail(string $email): array
    {
        $sql = 'SELECT * FROM users WHERE email = :email ';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);

        return $stmt->fetch();
    }
}