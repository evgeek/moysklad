<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Http;

use GuzzleHttp\BodySummarizer;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GuzzleSender implements RequestSenderInterface
{
    private Client $client;

    public function __construct()
    {
        $handlerStack = HandlerStack::create();
        $handlerStack->push(Middleware::httpErrors(new BodySummarizer(4000)), 'http_errors');
        $this->client = new Client(['handler' => $handlerStack]);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        return $this->client->send($request);
    }
}