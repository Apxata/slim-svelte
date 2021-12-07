<?php

namespace App\Controller;

use App\Model\Guest\GuestQuery;
use App\Service\MyService;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

class HomeController
{
    private LoggerInterface $logger;
    private MyService $myService;
    private ContainerInterface $container;
    private GuestQuery $guestQuery;

    public function __construct(
        LoggerInterface $logger,
        MyService $myService,
        ContainerInterface $container,
        GuestQuery $guestQuery
    )
    {
        $this->logger = $logger;
        $this->myService = $myService;
        $this->container = $container;
        $this->guestQuery = $guestQuery;
    }

    public function home(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface
    {
//        $response->getBody()->write("Hello home" . $this->myService->sayHello());
        $data = $this->guestQuery->getAllGuests();
        $items = $this->guestQuery->get100items();
        $payload = json_encode($data) . json_encode($items);

        $response->getBody()->write($payload);
//        $connection = $this->container->get('connection');
//        $sql = "CREATE TABLE IF NOT EXISTS MyGuests (
//                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//                firstname VARCHAR(30) NOT NULL,
//                lastname VARCHAR(30) NOT NULL,
//                email VARCHAR(50),
//                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
//                )";
//
//        $res = $this->connection->exec($sql);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function date(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface
    {
//        $response->getBody()->write("Hello home" . $this->myService->sayHello());
        $data = date('Y-m-d H:i:s');
        $payload = json_encode($data);

        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}