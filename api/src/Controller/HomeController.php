<?php

namespace App\Controller;

use App\Service\MyService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

class HomeController
{
    private LoggerInterface $logger;
    private MyService $myService;

    public function __construct(
        LoggerInterface $logger,
        MyService $myService
    )
    {
        $this->logger = $logger;
        $this->myService = $myService;
    }

    public function home(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseInterface
    {
//        $response->getBody()->write("Hello home" . $this->myService->sayHello());
        $data = 'Strannik';
        $payload = json_encode($data);

        $response->getBody()->write($payload);

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