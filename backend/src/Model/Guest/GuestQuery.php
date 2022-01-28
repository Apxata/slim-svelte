<?php
declare(strict_types=1);

namespace App\Model\Guest;


use App\Database\PDO2;
use PDO;

class GuestQuery
{

    private PDO $conn;
    private PDO2 $conn2;

    public function __construct(
        PDO $conn,
        PDO2 $conn2
    )
    {
        $this->conn = $conn;
        $this->conn2 = $conn2;
    }

    public function getAllGuests(): array
    {
        $sql = 'SELECT * FROM MyGuests ';
        $sth =  $this->conn->prepare($sql);
        $sth->execute();

        return $sth->fetchAll(2);
    }

    public function get100items(): array
    {
        $sql = 'SELECT * FROM shop_item LIMIT 100 ';
        $sth =  $this->conn2->prepare($sql);
        $sth->execute();

        return $sth->fetchAll(2);
    }
}