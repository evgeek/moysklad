<?php

namespace Evgeek\Tests\Unit\Exceptions;

use Evgeek\Moysklad\Exceptions\RequestException;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\Url;
use Exception;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use stdClass;
use Throwable;

/** @covers \Evgeek\Moysklad\Exceptions\RequestException */
class RequestExceptionTest extends TestCase
{
    public function testResponseNotResolvedWithoutPrevious(): void
    {
        $exception = $this->makeRequestException();

        $this->assertNull($exception->getResponse());
    }

    public function testResponseNotResolvedFromPreviousWithoutGetResponseMethod(): void
    {
        $exception = $this->makeRequestException(previous: new Exception());

        $this->assertNull($exception->getResponse());
    }

    public function testRequestNotResolvedFromPreviousWithoutGetRequestMethod(): void
    {
        $exception = $this->makeRequestException(previous: new Exception());

        $this->assertNull($exception->getRequest());
    }

    public function testResponseNotResolvedFromPreviousWithInvalidGetResponseMethod(): void
    {
        $invalidException = new class() extends Exception {
            public function getResponse()
            {
                return null;
            }
        };
        $exception = $this->makeRequestException(previous: $invalidException);

        $this->assertNull($exception->getResponse());
    }

    public function testRequestNotResolvedFromPreviousWithInvalidGetRequestMethod(): void
    {
        $invalidException = new class() extends Exception {
            public function getRequest()
            {
                return null;
            }
        };
        $exception = $this->makeRequestException(previous: $invalidException);

        $this->assertNull($exception->getRequest());
    }

    public function testResponseResolvedFromPreviousWithCorrectGetResponseMethod(): void
    {
        $exception = $this->makeCorrectWithResponseException();

        $this->assertInstanceOf(Response::class, $exception->getResponse());
    }

    public function testRequestResolvedFromPreviousWithCorrectGetResponseMethod(): void
    {
        $exception = $this->makeCorrectWithRequestException('GET', Url::API);

        $this->assertInstanceOf(Request::class, $exception->getRequest());
    }

    public function testContentNotResolvedWithoutResponse(): void
    {
        $exception = $this->makeRequestException();

        $this->assertNull($exception->getContent());
    }

    public function testContentResolvedCorrectly(): void
    {
        $exception = $this->makeCorrectWithResponseException('{"key": "value"}');
        $content = $exception->getContent();

        $this->assertInstanceOf(stdClass::class, $content);
        $this->assertCount(1, (array) $content);
        $this->assertSame('value', $content->key);
        $this->assertSame(json_encode($content), json_encode($exception->getContent()));
    }

    private function makeCorrectWithResponseException(string $body = null): RequestException
    {
        $exception = new class($body) extends Exception {
            public function __construct(private readonly ?string $body, string $message = '', int $code = 0, ?Throwable $previous = null)
            {
                parent::__construct($message, $code, $previous);
            }

            public function getResponse(): Response
            {
                return new Response(body: $this->body);
            }
        };

        return $this->makeRequestException($exception);
    }

    private function makeCorrectWithRequestException(string $method, string $uri): RequestException
    {
        $exception = new class($method, $uri) extends Exception {
            public function __construct(
                private readonly string $method,
                private readonly string $uri,
                string $message = '',
                int $code = 0,
                ?Throwable $previous = null,
            ) {
                parent::__construct($message, $code, $previous);
            }

            public function getRequest(): Request
            {
                return new Request($this->method, $this->uri);
            }
        };

        return $this->makeRequestException($exception);
    }

    private function makeRequestException(?Throwable $previous = null): RequestException
    {
        $formatter = (new MoySklad(['token']))->getFormatter();

        return new RequestException($formatter, '', 0, $previous);
    }
}
