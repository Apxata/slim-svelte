<?php

namespace App\Controller;

use App\Model\Guest\GuestQuery;
use App\Service\MyService;
use Picqer\Barcode\BarcodeGeneratorSVG;
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
        Response $response,
        array $args
    ): ResponseInterface
    {

//        $data = $this->guestQuery->getAllGuests();
//        $items = $this->guestQuery->get100items();
//        $payload = json_encode($data) . json_encode($items);
        $name = 'braen';
//        $code = Barcoder::ean8('0147400000440')->toSvg();
        $generator = new BarcodeGeneratorSVG();
        $code = '081231723897';
        $redColor = [255, 0, 0];
        $barcodeEAN = $generator->getBarcode($code, $generator::TYPE_EAN_13,1, 40, 'black');
        $barcode128 = $generator->getBarcode($code, $generator::TYPE_CODE_128, 1, 40, 'black');

//        dd($code);
//       return $response->render('home.twig', ['name' => $name]);

        $response->getBody()->write(
            $this->twig->render('home.twig', [
                'code' => $code,
                'barcodeEAN' => $barcodeEAN,
                'barcode128' => $barcode128
            ])
        );

        return $response;
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