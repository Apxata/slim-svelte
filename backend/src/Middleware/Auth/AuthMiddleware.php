<?php


namespace App\Middleware\Auth;

use App\Service\AuthService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class AuthMiddleware
{
    private AuthService $authService;

    /**
     * AuthMiddleware constructor.
     */
    public function __construct(
        AuthService $authService
    )
    {
        $this->authService = $authService;
    }

    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface
    {
        $cookie = $request->getCookieParams();

        if($cookie['session_id']) {

            $result = $this->authService->isSessionTokenValid($cookie['session_id']);

            if($result === true) {
                return $handler->handle($request);
            } else {
                $response = new Response();
                return $response->withHeader('Location', '/login');
            }
        }
        $response = new Response();
        return $response->withHeader('Location', '/login');
    }
}