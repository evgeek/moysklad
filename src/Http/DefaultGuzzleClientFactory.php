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

class DefaultGuzzleClientFactory
{
    public static function make(?callable $handler, int $retries, int $exceptionTruncateAt): Client
    {
        $handlerStack = HandlerStack::create($handler);

        static::pushRetriesMiddleware($handlerStack, $retries);
        static::pushBodySummarizerMiddleware($handlerStack, $exceptionTruncateAt);

        return new Client(['handler' => $handlerStack]);
    }

    protected static function pushRetriesMiddleware(HandlerStack $handlerStack, int $retries): void
    {
        $handlerStack->push(Middleware::retry(static function (
            int $currentRetry,
            RequestInterface $request,
            ?ResponseInterface $response,
            ?GuzzleException $exception,
        ) use ($retries) {
            if ($currentRetry >= $retries) {
                return false;
            }

            if ($exception instanceof ConnectException) {
                return true;
            }

            $statusCode = $response?->getStatusCode();

            return $statusCode >= 500 || $statusCode === 429;
        }));
    }

    protected static function pushBodySummarizerMiddleware(HandlerStack $handlerStack, int $truncateAt): void
    {
        $handlerStack->push(Middleware::httpErrors(new BodySummarizer($truncateAt)), 'http_errors');
    }
}
