<?php
declare(strict_types=1);

namespace App\Controller\Access;

use App\Model\Access\RegisterCommand;
use App\Model\Access\RegisterQuery;
use App\Service\AuthService;
use Cassandra\Date;
use DateTime;
use Exception;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;

class RegisterController
{
    private LoggerInterface $logger;
    private ContainerInterface $container;
    private RegisterQuery $registerQuery;
    private RegisterCommand $registerCommand;
    const BASE_ROLE = 'newcomer';
    private AuthService $authService;


    public function __construct(
        LoggerInterface $logger,
        ContainerInterface $container,
        RegisterQuery $registerQuery,
        RegisterCommand $registerCommand,
        AuthService $authService
    )
    {
        $this->logger = $logger;
        $this->container = $container;
        $this->registerQuery = $registerQuery;
        $this->registerCommand = $registerCommand;
        $this->authService = $authService;
    }

    public function register(
        Request $request,
        Response $response,
        array $args
    ): Response
    {
        try {
            $message = [];
            $data = $request->getParsedBody();
            if ($data) {
                $email = $data['email'];
                $password = $data['password'];
                $nickname = $data['name'];

                if ($this->isUnique($email)) {
                    $password_hash = password_hash($password, PASSWORD_BCRYPT);
                    $date_create = date('Y-m-d H:i:s');
                    $this->registerCommand->register(
                        $email,
                        $password_hash,
                        $date_create,
                        $nickname,
                        self::BASE_ROLE
                    );
                    $message['success'] = 'Вы были успешно зарегистрированы';
                } else {
                    $message['error'] = $email . ' Адрес почты не уникальный';
                    $this->logger->warning($message['error']);
                }
            }
        } catch (Exception $exception) {
            $this->logger->critical($exception->getMessage());
        }

        $response->getBody()->write(json_encode($message));

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
        if ($email) {
            return false;
        } else {
            return true;
        }
    }

    public function register_simple(
        Request $request,
        Response $response,
        array $args): Response
    {
        try {
            $response_message = [];
            $data = $request->getParsedBody();
            if ($data) {
                $email = $data['email'];
                $password = $data['password'];
                $nickname = $data['name'];

                if ($this->isUnique($email)) {
                    $password_hash = password_hash($password, PASSWORD_BCRYPT);
                    $date_create = date('Y-m-d H:i:s');
                    $this->registerCommand->register(
                        $email,
                        $password_hash,
                        $date_create,
                        $nickname,
                        self::BASE_ROLE
                    );
                    $message['success'] = 'Вы были успешно зарегистрированы';
                } else {
                    $response_message = [
                        'status' => 409,
                        'body' => 'User already exist'
                    ];
                    $this->logger->warning('Пользователь уже есть');
                    $response->getBody()->write(json_encode($response_message));

                    return $response;
                }
            }
        } catch (Exception $exception) {
            $this->logger->critical($exception->getMessage());
        }

//       $cookieId = Uuid::uuid4()->toString();
//       $_SESSION['user_id'] = $cookieId;
//       $max_age = time() + (60 * 60 * 24 * 30);
//       setcookie('session_id', $cookieId, $max_age, "/");
       $this->authService->setAuthCookie();
       $response->getBody()->write(json_encode(['message' => 'Success']));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}