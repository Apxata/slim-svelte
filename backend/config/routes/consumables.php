<?php

use App\Controller\Consumables\ConsumablesController;
use Slim\Routing\RouteCollectorProxy;

return function ($group) {
     $group->group('/consumables', function (RouteCollectorProxy $group) {
        $group->post('/get_items', ConsumablesController::class . ':items');
        $group->get('/items/find', ConsumablesController::class . ':find_items');

    });
};