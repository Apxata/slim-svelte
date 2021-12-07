<?php

namespace App\Controller\Access;

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
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

}