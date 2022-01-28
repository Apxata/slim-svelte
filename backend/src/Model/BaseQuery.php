<?php


namespace App\Model;

use PDO;

class BaseQuery
{
    public function fetchOne(\PDOStatement $stmt)
    {
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$res) {
            return null;
        } else {
            return $res;
        }
    }
}