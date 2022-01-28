<?php


namespace App\Service;


use App\Model\Access\LoginCommand;
use App\Model\Access\LoginQuery;
use App\Model\Consumables\ConsumablesQuery;

class ConsumablesService
{
    private ConsumablesQuery $consumablesQuery;

    public function __construct(
        ConsumablesQuery $consumablesQuery
    )
    {
        $this->consumablesQuery = $consumablesQuery;
    }
    public function findConsNamesItemByName(string $name): bool|array
    {
        return $this->consumablesQuery->findNamesByName($name);
    }

    public function getAllConsumables(): ?array
    {
        return $this->consumablesQuery->findAllConsumables();
    }
}