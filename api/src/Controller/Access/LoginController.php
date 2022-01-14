<?php
declare(strict_types=1);

namespace App\Controller\Access;

use App\Model\Access\LoginCommand;
use App\Model\Access\LoginQuery;
use App\Model\Access\RegisterQuery;
use App\Service\AuthService;
use App\Service\MyService;
use Exception;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


class LoginController
{
    private LoggerInterface $logger;
    private MyService $myService;
    private LoginQuery $loginQuery;
    private LoginCommand $loginCommand;
    private AuthService $authService;

    public function __construct(
        LoggerInterface $logger,
        MyService $myService,
        LoginQuery $loginQuery,
        LoginCommand $loginCommand,
        AuthService $authService
    )
    {
        $this->authService = $authService;
        $this->logger = $logger;
        $this->myService = $myService;
        $this->loginQuery = $loginQuery;
        $this->loginCommand = $loginCommand;
    }

    public function login(
        Request $request,
        Response $response,
        array $args
    ): Response
    {

        $message = [];
        try {
            $loginData = $request->getParsedBody();
            if ($loginData) {
                $email = $loginData['email'];
                $password = $loginData['password'];

                $userData = $this->getByEmail($email);

                if (!$userData) {
                    $msg = [
                        'status' => 401,
                        'body' => [
                            'message' => 'Пароль или логин не подходят'
                        ]
                    ];
                    $response->getBody()->write(json_encode($msg));
                    return $response;
                } else {
                    $password_verify = password_verify($password, $userData['password_hash']);
                    if ($password_verify === true) {
                        $user_id = (int)$userData['id'];
                        $token = $this->createToken($user_id);
                        $message['success'] = 'Вы успешно вошли';
                        $message['token'] = $token;
                    }
                }
            } else {
                //TODO password or email wrong
            }
        } catch (Exception $exception) {
            $this->logger->critical($exception->getMessage());
        }

        $response->getBody()->write(json_encode($message));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    private function getByEmail(string $email): array|bool
    {
        return $this->loginQuery->getByEmail($email);
    }

    /**
     * @throws Exception
     */
    private function createToken(int $user_id): string
    {
        $token = Uuid::uuid4()->toString();
        $date_create = date('Y-m-d H:i:s');
        $date_expired = strtotime($date_create . "+ 30 days");
        $date_expired = date('Y-m-d H:i:s', $date_expired);
        try {
            $this->loginCommand->createToken($user_id, $token, $date_create, $date_expired);
        } catch (Exception $exception) {
            $this->logger->emergency($exception->getMessage());
        }

        return $token;
    }

    public function login_q(
        Request $request,
        Response $response,
        array $args
    ): Response
    {

        $message = [];
        try {
            $data = $request->getParsedBody();
            if ($data) {
                $email = $data['email'];
                $password = $data['password'];
                $userData = $this->getByEmail($email);
                if (!$userData) {
                    $msg = [
                        'status' => 401,
                        'body' => [
                            'message' => 'Пароль или логин не подходят'
                        ]
                    ];
                    $response->getBody()->write(json_encode($msg));
                    return $response;
                }

                $password_verify = password_verify($password, $userData['password_hash']);
                if ($password_verify === true) {
                    $user_id = (int)$userData['id'];
                    $this->authService->setAuthCookie($user_id);
                    $msg = [
                        'status' => 200,
                        'body' => [
                            'message' => 'Вы успешно вошли'
                        ]
                    ];
                    $response->getBody()->write(json_encode($msg));
                    return $response->withHeader('Location', '/profile');
                } else {
                    $msg = [
                        'status' => 401,
                        'body' => [
                            'message' => 'Пароль или логин не подходят'
                        ]
                    ];
                    $response->getBody()->write(json_encode($msg));
                    return $response;
                }

            }
        } catch (Exception $exception) {
            $this->logger->critical($exception->getMessage());
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(500);
        }

        $response->getBody()->write(json_encode($message));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}