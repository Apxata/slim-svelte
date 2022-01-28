<?php


namespace App\Controller\Consumables;


use App\Service\ConsumablesService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Environment as Twig;

class ConsumablesController
{

    private ConsumablesService $consumablesService;

    public function __construct(
        ConsumablesService $consumablesService
    )
    {
        $this->consumablesService = $consumablesService;
    }

    public function items(
        Request $request,
        Response $response,
        array $args
    ): Response
    {

        try {
            $data = $request->getParsedBody();
            $item = $data['ItemName'];
            $result = $this->consumablesService->findConsNamesItemByName($item);

            if ($result) {
                $msg = [
                    'success' => true,
                    'body' => $result
                ];
                $response->getBody()->write(json_encode($msg));
                return $response->withStatus(200);
            } else {
                $msg = [
                    'success' => false,
                    'message' => 'Ничего не нашли'
                ];
                $response->getBody()->write(json_encode($msg));
                return $response->withStatus(200);
            }

        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function find_items(
        Request $request,
        Response $response,
        array $args
    ): Response
    {
        $params = $request->getQueryParams();
        if ($params) {
            $search_id = $params['search'];

            if($search_id === 'all') {
                $all_items = $this->consumablesService->getAllConsumables();
                $msg = [
                    'success' => true,
                    'body' => $all_items
                ];
                $response->getBody()->write(json_encode($msg));
                return $response->withStatus(200);
            }
         }
    }


}