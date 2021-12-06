<?php

namespace App\Controller;

use App\Service\MyService;
use Psr\Log\LoggerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;


class LoginController
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

    public function login(
        Request $request,
        Response $response,
        array $args
    ): Response
    {
        $payload = '';
        $loginData = $request->getParsedBody();

        if($loginData) {
            $login['email'] = $loginData['email'];
            $login['pasword'] = $loginData['password'];
            $payload = json_encode($login);
        }

        $response->getBody()->write($payload);

        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Credentials', 'true')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

}