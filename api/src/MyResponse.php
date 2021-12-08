<?php


namespace App;


use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\StreamInterface;
use Slim\Psr7\Interfaces\HeadersInterface;
use Slim\Psr7\Response;
use Twig\Environment;

class MyResponse extends Response
{
    private Environment $twig;

    public function __construct(
        int $status = StatusCodeInterface::STATUS_OK,
        ?HeadersInterface $headers = null,
        ?StreamInterface $body = null,
        Environment $twig
    )
    {
        parent::__construct($status, $headers, $body);
        $this->twig = $twig;
    }

    /**
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig\Error\LoaderError
     */
    public function render(string $filename, array $options)
    {
        $this->getBody()->write(
            $this->twig->render(
                $filename, $options
            )
        );

        return $this;
    }

}