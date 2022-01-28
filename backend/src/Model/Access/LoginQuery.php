<?php


namespace App\Model\Access;


use App\Database\PDO2;
use App\Model\BaseQuery;
use PDO;
use Psr\Log\LoggerInterface;

class LoginQuery extends BaseQuery
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

    public function getByEmail(string $email): array|bool
    {
        $sql = 'SELECT * FROM users WHERE email = :email ';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function findByToken($token): array|bool
    {
        $sql = 'SELECT * FROM user_token WHERE token = :token ORDER BY id DESC ';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['token' => $token]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}