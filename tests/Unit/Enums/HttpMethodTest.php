<?php

namespace Evgeek\Tests\Unit\Enums;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Enums\QueryParam;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\Enums\HttpMethod */
class HttpMethodTest extends TestCase
{
    /** @dataProvider httpMethodsDataProvider */
    public function testMakeFromCorrectMethods(HttpMethod $expectedMethod, HttpMethod|string $passedMethod): void
    {
        $this->assertSame($expectedMethod, HttpMethod::makeFrom($passedMethod));
    }

    public static function httpMethodsDataProvider(): array
    {
        return [
            [HttpMethod::GET, 'GET'],
            [HttpMethod::POST, 'post'],
            [HttpMethod::PUT, 'pUt'],
            [HttpMethod::PATCH, HttpMethod::PATCH],
            [HttpMethod::DELETE, 'DeLeTe'],
        ];
    }

    public function testMakeFromInvalidMethod(): void
    {
        $invalidMethod = 'invalid method';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("'" . strtoupper($invalidMethod) . "' is not valid HTTP method");

        HttpMethod::makeFrom($invalidMethod);
    }
}
