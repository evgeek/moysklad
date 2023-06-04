<?php

namespace Evgeek\Tests\Unit\Tools;

use Evgeek\Moysklad\Tools\Guid;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\Tools\Guid */
class GuidTest extends TestCase
{
    private const GUID1 = '25cf41f2-b068-11ed-0a80-0e9700500d7e';
    private const GUID2 = 'f731148b-a93d-11ed-0a80-0fba0011a6c6';
    private const GUID3 = 'cbcf493b-55bc-11d9-848a-00112f43529a';

    /** @dataProvider extractAllDataProvider */
    public function testExtractAll(array $expected, string $url): void
    {
        $this->assertSame($expected, Guid::extractAll($url));
    }

    public static function extractAllDataProvider(): array
    {
        return [
            [[], 'entity/product/position'],
            [[], 'entity/f7321b22-a93d/11ed-0a80-0fba0011a6c7/position'],
            [[self::GUID1, self::GUID2], 'product/' . self::GUID1 . '/position/' . self::GUID2],
            [[self::GUID3, self::GUID2, self::GUID1], 'method/' . self::GUID3 . '/method/' . self::GUID2 . '/method/' . self::GUID1],
        ];
    }

    /** @dataProvider extractFirstDataProvider */
    public function testExtractFirst(?string $expected, string $url): void
    {
        $this->assertSame($expected, Guid::extractFirst($url));
    }

    public static function extractFirstDataProvider(): array
    {
        return [
            [null, 'entity/product/position'],
            [null, 'entity/f7321b22-a93d/11ed-0a80-0fba0011a6c7/position'],
            [self::GUID1, 'product/' . self::GUID1 . '/position/' . self::GUID2],
            [self::GUID3, 'method/' . self::GUID3 . '/method/' . self::GUID2 . '/method/' . self::GUID1],
        ];
    }

    /** @dataProvider extractLastDataProvider */
    public function testExtractLast(?string $expected, string $url): void
    {
        $this->assertSame($expected, Guid::extractLast($url));
    }

    public static function extractLastDataProvider(): array
    {
        return [
            [null, 'entity/product/position'],
            [null, 'entity/f7321b22-a93d/11ed-0a80-0fba0011a6c7/position'],
            [self::GUID2, 'product/' . self::GUID1 . '/position/' . self::GUID2],
            [self::GUID1, 'method/' . self::GUID3 . '/method/' . self::GUID2 . '/method/' . self::GUID1],
        ];
    }

    public function testIsGuidRecognizeCorrectGuid(): void
    {
        $this->assertTrue(Guid::check(self::GUID1));
    }

    public function testIsGuidRejectIncorrectGuid(): void
    {
        $this->assertFalse(Guid::check('wrong-guid'));
    }
}
