<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Http;

use GuzzleHttp\BodySummarizer;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class GuzzleFactory implements GuzzleFactoryInterface
{
    public function make(): Client
    {
        $handlerStack = HandlerStack::create();
        $handlerStack->push(Middleware::httpErrors(new BodySummarizer(4000)), 'http_errors');

        return new Client(['handler' => $handlerStack]);
    }
}
