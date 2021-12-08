<?php

namespace App\Controller;

use App\Model\Guest\GuestQuery;
use App\MyResponse;
use App\Service\MyService;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Slim\Psr7\Response;
use Twig\Environment as Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeController
{
    private LoggerInterface $logger;
    private MyService $myService;
    private ContainerInterface $container;
    private GuestQuery $guestQuery;
    private Twig $twig;

    public function __construct(
        LoggerInterface $logger,
        MyService $myService,
        ContainerInterface $container,
        GuestQuery $guestQuery,
        Twig $twig
    )
    {
        $this->logger = $logger;
        $this->myService = $myService;
        $this->container = $container;
        $this->guestQuery = $guestQuery;
        $this->twig = $twig;
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function home(
        ServerRequestInterface $request,
        MyResponse $response,
        array $args
    ): ResponseInterface
    {

//        $data = $this->guestQuery->getAllGuests();
//        $items = $this->guestQuery->get100items();
//        $payload = json_encode($data) . json_encode($items);
        $name = 'braen';

       return $response->render('home.twig', ['name' => $name]);

//        $response->getBody()->write(
//            $this->twig->render('home.twig', ['name' => $name])
//        );

//        return $response;
//            ->withHeader('Content-Type', 'application/json')
//            ->withStatus(200);
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
}