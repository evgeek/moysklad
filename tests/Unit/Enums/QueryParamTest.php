<?php

namespace Evgeek\Tests\Unit\Enums;

use Evgeek\Moysklad\Enums\QueryParam;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\Enums\QueryParam */
class QueryParamTest extends TestCase
{
    /** @dataProvider separatorDataProvider */
    public function testSeparator(QueryParam $queryParam, string $separator): void
    {
        $this->assertSame($separator, $queryParam->separator());
    }

    public static function separatorDataProvider(): array
    {
        return [
            [QueryParam::EXPAND, ','],
            [QueryParam::FILTER, ';'],
            [QueryParam::ORDER, ';'],
            [QueryParam::LIMIT, ''],
            [QueryParam::OFFSET, ''],
            [QueryParam::SEARCH, ''],
        ];
    }

    /** @dataProvider getSeparatorDataProvider */
    public function testGetSeparator(QueryParam|string $queryParam, string $separator): void
    {
        $this->assertSame($separator, QueryParam::getSeparator($queryParam));
    }

    public static function getSeparatorDataProvider(): array
    {
        return array_merge(self::separatorDataProvider(), [
            ['expand', ','],
            ['FILTER', ';'],
            ['OrdEr', ';'],
            ['limit', ''],
            ['offset', ''],
            ['search', ''],
            ['unknown', ''],
        ]);
    }
}
