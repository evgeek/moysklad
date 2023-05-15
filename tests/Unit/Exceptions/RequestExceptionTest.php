<?php

namespace Evgeek\Tests\Unit\Exceptions;

use Evgeek\Moysklad\Exceptions\RequestException;
use Evgeek\Moysklad\MoySklad;
use Exception;
use GuzzleHttp\Exception\ConnectException;
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
        $previous = new ConnectException('', new Request('GET', 'https://example.com'));
        $exception = $this->makeRequestException(previous: $previous);

        $this->assertNull($exception->getResponse());
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

    public function testResponseResolvedFromPreviousWithCorrectGetResponseMethod(): void
    {
        $exception = $this->makeCorrectException();

        $this->assertInstanceOf(Response::class, $exception->getResponse());
    }

    public function testContentNotResolvedWithoutResponse(): void
    {
        $exception = $this->makeRequestException();

        $this->assertNull($exception->getContent());
    }

    public function testContentResolvedCorrectly(): void
    {
        $exception = $this->makeCorrectException('{"key": "value"}');
        $content = $exception->getContent();

        $this->assertInstanceOf(stdClass::class, $content);
        $this->assertCount(1, (array) $content);
        $this->assertSame('value', $content->key);
        $this->assertSame(json_encode($content), json_encode($exception->getContent()));
    }

    private function makeCorrectException(string $body = null): RequestException
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

    private function makeRequestException(?Throwable $previous = null): RequestException
    {
        $formatter = (new MoySklad(['token']))->getApiClient()->getFormatter();

        return new RequestException($formatter, '', 0, $previous);
    }
}
