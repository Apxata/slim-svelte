<?php
declare(strict_types=1);

namespace App\Controller\Access;

use App\Model\Access\RegisterCommand;
use App\Model\Access\RegisterQuery;
use Cassandra\Date;
use DateTime;
use Exception;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;

class RegisterController
{
    private LoggerInterface $logger;
    private ContainerInterface $container;
    private RegisterQuery $registerQuery;
    private RegisterCommand $registerCommand;
    CONST BASE_ROLE = 'newcomer';


    public function __construct(
        LoggerInterface $logger,
        ContainerInterface $container,
        RegisterQuery $registerQuery,
        RegisterCommand $registerCommand
    )
    {
        $this->logger = $logger;
        $this->container = $container;
        $this->registerQuery = $registerQuery;
        $this->registerCommand = $registerCommand;
    }

    public function register(
        Request $request,
        Response $response,
        array $args
    ): Response
    {
        try {
            $data = $request->getParsedBody();
            if($data) {
                $email = $data['email'];
                $password = $data['password'];

                if($this->isUnique($email)) {
                    $password_hash = password_hash($password , PASSWORD_BCRYPT);
                    $date_create = date('Y-m-d H:i:s');
                    $this->registerCommand->register(
                        $email,
                        $password_hash,
                        $date_create,
                        '',
                        self::BASE_ROLE
                    );
                }
            }
        } catch (Exception $exception) {
            $this->logger->critical($exception->getMessage());
        }

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
        $data = date('Y-m-d H:i:s');
        $payload = json_encode($data);

        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    private function isUnique(string $email): bool
    {
        $email = $this->registerQuery->getByEmail($email);
        if($email) {
            return false;
        } else {
            return true;
        }
    }
}