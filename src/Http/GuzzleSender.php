<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Http;

use GuzzleHttp\Client;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GuzzleSender implements RequestSenderInterface
{
    private Client $client;

    public function __construct(GuzzleFactoryInterface $factory = null)
    {
        if (!$factory) {
            $factory = new GuzzleFactory();
        }
        $this->client = $factory->make();
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        return $this->client->send($request);
    }
}
