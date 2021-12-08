<?php
declare(strict_types=1);

namespace App\Controller\Access;

use App\Model\Access\RegisterQuery;
use App\Service\MyService;
use Exception;
use Psr\Log\LoggerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;


class LoginController
{
    private LoggerInterface $logger;
    private MyService $myService;
    private RegisterQuery $registerQuery;

    public function __construct(
        LoggerInterface $logger,
        MyService $myService,
        RegisterQuery $registerQuery
    )
    {
        $this->logger = $logger;
        $this->myService = $myService;
        $this->registerQuery = $registerQuery;
    }

    public function login(
        Request $request,
        Response $response,
        array $args
    ): Response
    {

        try {
            $loginData = $request->getParsedBody();

            if ($loginData) {
                $email = $loginData['email'];
                $password = $loginData['password'];

                $data = $this->getByEmail($email);
                if($data) {
                    $password_verify = password_verify($password, $data['password_hash']);
                }


            }
        }
        catch (Exception $exception){
            $this->logger->critical($exception->getMessage());
        }

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    private function getByEmail(string $email): ?string
    {
        return $this->registerQuery->getByEmail($email);
    }

}