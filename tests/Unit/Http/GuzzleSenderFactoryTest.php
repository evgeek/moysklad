<?php

namespace Evgeek\Tests\Unit\Http;

use Evgeek\Moysklad\Http\GuzzleSender;
use Evgeek\Moysklad\Http\GuzzleSenderFactory;
use Evgeek\Moysklad\Http\RequestSenderInterface;
use Evgeek\Moysklad\Services\Url;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

/** @covers \Evgeek\Moysklad\Http\GuzzleSenderFactory */
class GuzzleSenderFactoryTest extends TestCase
{
    private HandlerStack|MockHandler $mockHandler;
    protected function setUp(): void
    {
        $this->mockHandler = MockHandler::createWithMiddleware();
    }

    public function testMakeReturnsCorrectClassAndInterface(): void
    {
        $factory = new GuzzleSenderFactory();
        $requestSender = $factory->make();

        $this->assertInstanceOf(GuzzleSender::class, $requestSender);
        $this->assertInstanceOf(RequestSenderInterface::class, $requestSender);
    }

    public function testMockedSenderReturnsExpectedResponse(): void
    {
        $factory = $this->createFactoryMock();
        $requestSender = $factory->make();

        $code = 201;
        $headers = ['Content-Type' => ['application/json']];
        $body = '{"status":"ok"}';

        $this->mockHandler->append(new Response($code, $headers, $body),);
        $response = $requestSender->send(new Request('GET', Url::API));

        $this->assertSame($code, $response->getStatusCode());
        $this->assertSame($headers, $response->getHeaders());
        $this->assertSame($body, $response->getBody()->getContents());
    }

    public function testRetry(): void
    {
        $responses = [
            new Response(429),
            new Response(429),
        ];
        $factory = $this->createFactoryMock($responses, 2);
        $requestSender = $factory->make();

        $response = $requestSender->send(new Request('GET', Url::API));

        $a = 5;
    }

    private function createFactoryMock(array $responses, int $retries = 1, int $exceptionTruncateAt = 120)
    {
        return new class ($retries, $exceptionTruncateAt, $responses) extends GuzzleSenderFactory {
            public array $container = [];

            public function __construct(int $retries, int $exceptionTruncateAt, private readonly array $responses)
            {
                parent::__construct($retries, $exceptionTruncateAt);
            }

            public function make(): RequestSenderInterface
            {
                $stack = MockHandler::createWithMiddleware($this->responses);

                return $this->makeFromHandlerStack($stack);
            }

            protected function pushMiddlewares(HandlerStack $handlerStack): void
            {
                parent::pushMiddlewares($handlerStack);

                $history = Middleware::history($this->container);
                $handlerStack->push($history);
            }
        };
    }
}
