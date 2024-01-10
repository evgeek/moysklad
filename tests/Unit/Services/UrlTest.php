<?php

namespace Evgeek\Tests\Unit\Services;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Http\Payload;
use Evgeek\Moysklad\Services\Url;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/** @covers \Evgeek\Moysklad\Services\Url */
class UrlTest extends TestCase
{
    private const API_URL = 'https://api.moysklad.ru/api/remap/1.2';
    private const GUID1 = '25cf41f2-b068-11ed-0a80-0e9700500d7e';
    private const GUID2 = 'f731148b-a93d-11ed-0a80-0fba0011a6c6';

    /** @dataProvider payloadDataProvider */
    public function testMakeWithCorrectPayload(string $expectedPath, array $path, array $params = []): void
    {
        $payload = new Payload(HttpMethod::GET, $path, $params, []);

        $this->assertSame(self::API_URL . $expectedPath, Url::make($payload));
    }

    public static function payloadDataProvider(): array
    {
        return [
            [
                '/entity',
                ['entity'],
            ],
            [
                '/entity/product?limit=1',
                ['entity', 'product'],
                ['limit' => 1],
            ],
            [
                '/endpoint/method?filter=archived%3Dfalse%3Bname%7E%3Dor&offset=2',
                ['endpoint', 'method'],
                ['filter' => 'archived=false;name~=or', 'offset' => 2],
            ],
        ];
    }

    public function testMakeWithWrongPath(): void
    {
        $path = [['entity']];
        $payload = new Payload(HttpMethod::GET, $path, [], []);

        set_error_handler(static function (int $code, string $message): never {
            throw new RuntimeException($message, $code);
        }, E_ALL);

        $this->expectExceptionMessage('Array to string conversion');

        Url::make($payload);

        restore_error_handler();
    }

    /** @dataProvider mixedValuesDataProvider */
    public function testConvertMixedValueToString(string $expectedValue, mixed $value): void
    {
        $this->assertSame($expectedValue, Url::convertMixedValueToString($value));
    }

    public static function mixedValuesDataProvider(): array
    {
        return [
            ['', ''],
            ['test', 'test'],
            ['TEST', 'TEST'],
            ['TesT', 'TesT'],
            ['true', true],
            ['false', false],
            ['0', 0],
            ['1', 1],
            ['-66', -66],
            ['123', 123],
            ['1.23', 1.23],
            ['1', 1.0],
            ['-1.0001', -1.0001],
        ];
    }

    /** @dataProvider urlForParsingDataProvider */
    public function testParsePathAndParamsWorksWithCorrectUrl(string $url, array $expectedPath, array $expectedParams): void
    {
        [$path, $params] = Url::parsePathAndParams($url);

        $this->assertSame($expectedPath, $path);
        $this->assertSame($expectedParams, $params);
    }

    public static function urlForParsingDataProvider(): array
    {
        return [
            [URL::API . '/segment1/segment2', ['segment1', 'segment2'], []],
            [URL::API . '/segment3/segment4/', ['segment3', 'segment4'], []],
            [
                URL::API . '/segment1/segment2?param1=value1&param2=value2',
                [
                    'segment1',
                    'segment2',
                ],
                [
                    'param1' => 'value1',
                    'param2' => 'value2',
                ],
            ],
            [
                URL::API . '/segment1/segment2/?param1=value1&param2=value2',
                [
                    'segment1',
                    'segment2',
                ],
                [
                    'param1' => 'value1',
                    'param2' => 'value2',
                ],
            ],
            [
                URL::API . '/segment3/segment4?filter=aa=bb;cc!=d\;d',
                [
                    'segment3',
                    'segment4',
                ],
                [
                    'filter' => 'aa=bb;cc!=d\;d',
                ],
            ],
            [
                URL::API . '/segment5/segment6?operation.id=a&b = c',
                [
                    'segment5',
                    'segment6',
                ],
                [
                    'operation.id' => 'a',
                    'b ' => ' c',
                ],
            ],
        ];
    }

    public function testParsePathAndParamsWorksWithWrongUrl(): void
    {
        $url = 'https://wrong-url.com';
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Url '$url' does not belongs to Moysklad JSON API v1.2");

        Url::parsePathAndParams($url);
    }

    /** @dataProvider urlForGetIdDataProvider */
    public function testGetId(string $url, ?string $expectedId): void
    {
        $this->assertSame($expectedId, Url::getId($url));
    }

    public static function urlForGetIdDataProvider(): array
    {
        return [
            [URL::API . '/' . self::GUID1, self::GUID1],
            [URL::API . '/' . self::GUID1 . '/', self::GUID1],
            [URL::API . '/' . self::GUID1 . '/' . self::GUID2, self::GUID2],
            [URL::API . '/' . self::GUID1 . '/segment', null],
        ];
    }
}
