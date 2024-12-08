<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Http;

use GuzzleHttp\Client;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GuzzleSender implements RequestSenderInterface
{
    public function __construct(private readonly Client $client, private readonly array $requestOptions = [])
    {
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        return $this->client->send($request, $this->requestOptions);
    }
}
