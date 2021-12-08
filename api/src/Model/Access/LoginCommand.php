<?php


namespace App\Model\Access;


use App\Database\PDO2;
use App\Service\MyService;
use PDO;
use Psr\Log\LoggerInterface;

class LoginCommand
{
    private PDO $conn;
    private PDO2 $conn2;
    private MyService $service;
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

    public function createToken(
        int $user_id,
        string $token,
        string $date_created,
        string $date_expired,
    ): void
    {
        $sql = 'INSERT INTO user_token (user_id, token, date_created, date_expired) 
            VALUES (:user_id, :token, :date_created, :date_expired)';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'user_id' => $user_id,
            'token' => $token,
            'date_created' => $date_created,
            'date_expired' => $date_expired
        ]);
    }
}