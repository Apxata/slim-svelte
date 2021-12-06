<?php


namespace App\Model\Guest;


use PDO;

class GuestQuery
{


    private \PDO $conn;

    public function __construct(
        \PDO $conn
    )
    {
        $this->conn = $conn;
    }

    public function getAllGuests(): array
    {
        $sql = 'SELECT * FROM MyGuests ';
        $sth =  $this->conn->prepare($sql);
        $sth->execute();

        return $sth->fetchAll(2);


    }
}