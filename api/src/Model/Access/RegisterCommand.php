<?php
declare(strict_types=1);

namespace App\Model\Access;

use App\Database\PDO2;
use App\Model\BaseCommand;
use App\Service\MyService;
use DateTime;
use PDO;
use Psr\Log\LoggerInterface;


class RegisterCommand
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

    public function register(
        string $email,
        string $password_hash,
        string $date_created,
        string $nickname,
        string $role
    ): void
    {
        $sql = 'INSERT INTO users (email, password_hash, date_created, nickname, role) 
            VALUES (:email, :password_hash, :date_created, :nickname, :role       
                )';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'email' => $email,
            'password_hash' => $password_hash,
            'date_created' => $date_created,
            'nickname' => $nickname,
            'role' => $role
        ]);
    }

}