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
        $this->assertEquals($separator, $queryParam->separator());
    }

    /** @dataProvider getSeparatorDataProvider */
    public function testGetSeparator(QueryParam|string $queryParam, string $separator): void
    {
        $this->assertEquals($separator, QueryParam::getSeparator($queryParam));
    }

    private function separatorDataProvider(): array
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

    private function getSeparatorDataProvider(): array
    {
        return array_merge($this->separatorDataProvider(), [
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
