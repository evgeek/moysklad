<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Http;

use GuzzleHttp\BodySummarizer;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GuzzleSenderFactory implements RequestSenderFactoryInterface
{
    public function __construct(private readonly int $retries = 1, private readonly int $exceptionTruncateAt = 120)
    {
    }

    public function make(): RequestSenderInterface
    {
        return $this->makeFromHandlerStack();
    }

    protected function makeFromHandlerStack(HandlerStack $handlerStack = null): GuzzleSender
    {
        $handlerStack = $handlerStack ?? HandlerStack::create();
        $client = $this->createClient($handlerStack);

        return new GuzzleSender($client);
    }

    protected function createClient(HandlerStack $handlerStack): Client
    {
        $this->pushMiddlewares($handlerStack);

        return new Client(['handler' => $handlerStack]);
    }

    protected function pushMiddlewares(HandlerStack $handlerStack): void
    {
        $handlerStack->push($this->getRetryMiddleware());
        $handlerStack->push($this->getHttpErrorsMiddlewareWithBodySummarizer(), 'http_errors');
    }

    protected function getRetryMiddleware(): callable
    {
        return Middleware::retry(function (
            int $currentRetry,
            RequestInterface $request,
            ?ResponseInterface $response,
            ?GuzzleException $exception,
        ) {
            if ($currentRetry >= $this->retries) {
                return false;
            }

            if ($exception instanceof ConnectException) {
                return true;
            }

            $statusCode = $response?->getStatusCode() ?? $exception?->getCode();

            return $statusCode >= 500 || $statusCode === 429;
        });
    }

    protected function getHttpErrorsMiddlewareWithBodySummarizer(): callable
    {
        return Middleware::httpErrors(new BodySummarizer($this->exceptionTruncateAt));
    }
}
