<?php
declare(strict_types=1);

namespace App\Controller\Access;

use App\Model\Access\LoginCommand;
use App\Model\Access\LoginQuery;
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
    private LoginQuery $loginQuery;
    private LoginCommand $loginCommand;

    public function __construct(
        LoggerInterface $logger,
        MyService $myService,
        LoginQuery $loginQuery,
        LoginCommand $loginCommand
    )
    {
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

        try {
            $token = '';
            $loginData = $request->getParsedBody();

            if ($loginData) {
                $email = $loginData['email'];
                $password = $loginData['password'];

                $data = $this->getByEmail($email);
                if($data) {
                    $password_verify = password_verify($password, $data['password_hash']);
                    if($password_verify === true) {
                        $user_id = (int)$data['id'];
                        $token = $this->createToken($user_id);
                    } else {
                        // TODO password or email wrong
                    }
                }else {
                    //TODO password or email wrong
                }
            }
        }
        catch (Exception $exception){
            $this->logger->critical($exception->getMessage());
        }

        $response->getBody()->write(json_encode($token));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    private function getByEmail(string $email): ?array
    {
        return $this->loginQuery->getByEmail($email);
    }

    /**
     * @throws Exception
     */
    private function createToken(int $user_id): string
    {
        $token = random_bytes(128);
        $date_create = date('Y-m-d H:i:s');
        $date_expired = strtotime($date_create."+ 30 days");
        $date_expired = date('Y-m-d H:i:s', $date_expired);
        try {
            $this->loginCommand->createToken($user_id, $token, $date_create, $date_expired );
        } catch (Exception $exception) {
            $this->logger->emergency($exception->getMessage());
        }

        return $token;
    }

}