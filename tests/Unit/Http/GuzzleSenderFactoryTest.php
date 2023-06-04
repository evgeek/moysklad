<?php

namespace Evgeek\Tests\Unit\Http;

use Evgeek\Moysklad\Http\GuzzleSender;
use Evgeek\Moysklad\Http\GuzzleSenderFactory;
use Evgeek\Moysklad\Http\RequestSenderInterface;
use Evgeek\Moysklad\Services\Url;
use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\Http\GuzzleSenderFactory */
class GuzzleSenderFactoryTest extends TestCase
{
    private MockHandler $mockHandler;

    protected function setUp(): void
    {
        $this->mockHandler = new MockHandler();
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

        $this->mockHandler->append(new Response($code, $headers, $body));

        $response = $requestSender->send(new Request('GET', Url::API));

        $this->assertSame($code, $response->getStatusCode());
        $this->assertSame($headers, $response->getHeaders());
        $this->assertSame($body, $response->getBody()->getContents());
    }

    public function testRetry(): void
    {
        $factory = $this->createFactoryMock(1);
        $requestSender = $factory->make();

        $this->mockHandler->append(new Response(500));
        $this->mockHandler->append(new Response(200));

        $requestSender->send(new Request('GET', Url::API));

        $this->assertCount(2, $factory->container);
    }

    /** @dataProvider retryableCodesDataProvider */
    public function testRetryWorksWithRetryableCodes(int $code, string $exception): void
    {
        $factory = $this->createFactoryMock(1);
        $requestSender = $factory->make();

        $this->mockHandler->append(new Response($code));
        $this->mockHandler->append(new Response($code));

        $this->expectException($exception);

        $requestSender->send(new Request('GET', Url::API));

        $this->assertCount(2, $factory->container);
    }

    public static function retryableCodesDataProvider(): array
    {
        return [
            [500, ServerException::class],
            [503, ServerException::class],
            [429, RequestException::class],
        ];
    }

    /** @dataProvider notRetryableCodesDataProvider */
    public function testRetryDoesNotWorksWithNotRetryableCodes(int $code, ?string $exception): void
    {
        $factory = $this->createFactoryMock(1);
        $requestSender = $factory->make();

        $this->mockHandler->append(new Response($code));
        $this->mockHandler->append(new Response($code));

        if ($exception) {
            $this->expectException($exception);
        }

        $requestSender->send(new Request('GET', Url::API));

        $this->assertCount(1, $factory->container);
    }

    public static function notRetryableCodesDataProvider(): array
    {
        return [
            [200, null],
            [201, null],
            [304, null],
            [403, ClientException::class],
            [409, ClientException::class],
        ];
    }

    public function testRetryWorksOnClientException(): void
    {
        $factory = $this->createFactoryMock(1);
        $requestSender = $factory->make();

        $this->mockHandler->append(new ConnectException('test message', new Request(200, Url::API)));
        $this->mockHandler->append(new ConnectException('test message', new Request(200, Url::API)));

        $this->expectException(ConnectException::class);

        $requestSender->send(new Request('GET', Url::API));

        $this->assertCount(2, $factory->container);
    }

    public function testRetryDoesNotWorksOnUnknownException(): void
    {
        $factory = $this->createFactoryMock(1);
        $requestSender = $factory->make();

        $this->mockHandler->append(new Exception());

        $this->expectException(Exception::class);

        $requestSender->send(new Request('GET', Url::API));

        $this->assertCount(1, $factory->container);
    }

    public function testExceptionBodyTruncated(): void
    {
        $factory = $this->createFactoryMock(exceptionTruncateAt: 10);
        $requestSender = $factory->make();

        $this->mockHandler->append(new Response(status: 500, body: 'response-body'));

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('response-b (truncated...)');

        $requestSender->send(new Request('GET', Url::API));
    }

    private function createFactoryMock(int $retries = 0, int $exceptionTruncateAt = 120)
    {
        return new class($this->mockHandler, $retries, $exceptionTruncateAt) extends GuzzleSenderFactory {
            public array $container = [];

            public function __construct(private readonly MockHandler $mockHandler, int $retries, int $exceptionTruncateAt)
            {
                parent::__construct($retries, $exceptionTruncateAt);
            }

            public function make(): GuzzleSender
            {
                return $this->makeFromHandler($this->mockHandler);
            }

            protected function pushMiddlewares(HandlerStack $handlerStack): void
            {
                parent::pushMiddlewares($handlerStack);

                $history = Middleware::history($this->container);
                $handlerStack->push($history);
            }

            protected function getDelay(): ?callable
            {
                return static fn () => 0;
            }
        };
    }
}
