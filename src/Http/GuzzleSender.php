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

    public function __construct(int $retries = 1, int $exceptionTruncateAt = 120)
    {
        $defaultClient = DefaultGuzzleClientFactory::make($retries, $exceptionTruncateAt);
        $this->setClient($defaultClient);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        return $this->client->send($request);
    }

    public function setClient(Client $client): void
    {
        $this->client = $client;
    }
}
