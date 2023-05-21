<?php

namespace Evgeek\Tests\Unit\Services;

use Evgeek\Moysklad\Enums\FilterSign;
use Evgeek\Moysklad\Enums\OrderDirection;
use Evgeek\Moysklad\Services\QueryParams;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\Services\QueryParams */
class QueryParamsTest extends TestCase
{
    private const PARAMS = [
        'param1' => 'value1',
        'param2' => 'value2',
    ];

    public function testSetSearchAddsToParams(): void
    {
        $searchText = 'search_text';

        $params = QueryParams::setSearch(self::PARAMS, $searchText);
        $this->assertSame(self::PARAMS + ['search' => $searchText], $params);
    }

    public function testSetSearchReplacedCurrentValue(): void
    {
        $params = self::PARAMS + ['search' => 'old_search'];
        $searchText = 'new_search';

        $params = QueryParams::setSearch($params, $searchText);
        $this->assertSame(self::PARAMS + ['search' => $searchText], $params);
    }

    public function testSetOrderWithDirection(): void
    {
        $params = QueryParams::setOrder(self::PARAMS, 'field', OrderDirection::DESC);
        $this->assertSame(self::PARAMS + ['order' => 'field,desc'], $params);
    }

    public function testSetOrderWithoutDirection(): void
    {
        $params = QueryParams::setOrder(self::PARAMS, 'field');
        $this->assertSame(self::PARAMS + ['order' => 'field,asc'], $params);
    }

    public function testSetOrderAddsToExistingValue(): void
    {
        $params = self::PARAMS + ['order' => 'field1,desc'];
        $params = QueryParams::setOrder($params, 'field2');
        $this->assertSame(self::PARAMS + ['order' => 'field1,desc;field2,asc'], $params);
    }

    public function testSetCorrectMultipleOrders(): void
    {
        $params = self::PARAMS + ['order' => 'field1,desc'];
        $params = QueryParams::setOrder($params, [
            ['field2'],
            ['field3', 'desc'],
            ['field4', OrderDirection::ASC],
        ]);
        $this->assertSame(self::PARAMS + ['order' => 'field1,desc;field2,asc;field3,desc;field4,asc'], $params);
    }

    public function testSetIncorrectMultipleOrders(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Each order must be an array');

        QueryParams::setOrder(self::PARAMS, ['field2']);
    }

    public function testSetLimitAddsToParams(): void
    {
        $limit = 100;
        $params = QueryParams::setLimit(self::PARAMS, $limit);
        $this->assertSame(self::PARAMS + ['limit' => (string) $limit], $params);
    }

    public function testSetLimitReplacedCurrentValue(): void
    {
        $limit = 200;
        $params = QueryParams::setLimit(self::PARAMS + ['limit' => '100'], $limit);
        $this->assertSame(self::PARAMS + ['limit' => (string) $limit], $params);
    }

    public function testSetOffsetAddsToParams(): void
    {
        $offset = 100;
        $params = QueryParams::setOffset(self::PARAMS, $offset);
        $this->assertSame(self::PARAMS + ['offset' => (string) $offset], $params);
    }

    public function testSetOffsetReplacedCurrentValue(): void
    {
        $offset = 200;
        $params = QueryParams::setOffset(self::PARAMS + ['offset' => '100'], $offset);
        $this->assertSame(self::PARAMS + ['offset' => (string) $offset], $params);
    }

    public function testSetFilterWithSignAddsToParams(): void
    {
        $params = QueryParams::setFilter(self::PARAMS, 'field', FilterSign::NEQ, false);
        $this->assertSame(self::PARAMS + ['filter' => 'field!=false'], $params);
    }

    public function testSetFilterWithoutSignAddsToParams(): void
    {
        $params = QueryParams::setFilter(self::PARAMS, 'field', 123.45);
        $this->assertSame(self::PARAMS + ['filter' => 'field=123.45'], $params);
    }

    public function testSetFilterAddedToExistingValue(): void
    {
        $params = self::PARAMS + ['filter' => 'field1!=value1'];
        $params = QueryParams::setFilter($params, 'field2', 100);
        $this->assertSame(self::PARAMS + ['filter' => 'field1!=value1;field2=100'], $params);
    }

    public function testSetFilterEscapesSemicolon(): void
    {
        $params = QueryParams::setFilter(self::PARAMS, 'field', FilterSign::GT, 'as;df');
        $this->assertSame(self::PARAMS + ['filter' => 'field>as\;df'], $params);
    }

    public function testSetFilterWithOnlyKeyThrowsException(): void
    {
        $key = 'field';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("For filter key '$key': sign missed");

        QueryParams::setFilter(self::PARAMS, $key);
    }

    public function testSetFilterWithEnumSignWithoutValueThrowsException(): void
    {
        $key = 'field';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("For filter key '$key': with a sign, you must pass the value as the third parameter");

        QueryParams::setFilter(self::PARAMS, $key, FilterSign::EQ);
    }

    public function testSetFilterWithIncorrectSignTypeWithValueThrowsException(): void
    {
        $key = 'field';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("For filter key '$key': with a value, sign must be a string or " . FilterSign::class);

        QueryParams::setFilter(self::PARAMS, $key, 33, 'value');
    }

    public function testSetCorrectMultipleFilters(): void
    {
        $params = self::PARAMS + ['filter' => 'field1=value1'];
        $params = QueryParams::setFilter($params, [
            ['field2', true],
            ['field3', '!=', 123.45],
            ['field4', FilterSign::LIKE, 'val;ue4'],
        ]);

        $expectedParams = self::PARAMS + ['filter' => 'field1=value1;field2=true;field3!=123.45;field4~val\;ue4'];
        $this->assertSame($expectedParams, $params);
    }

    public function testSetIncorrectMultipleFilters(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Each filter must be an array');

        QueryParams::setFilter(self::PARAMS, ['field2']);
    }

    public function testSetExpandAddsToParams(): void
    {
        $field = 'field';

        $params = QueryParams::setExpand(self::PARAMS, $field);
        $this->assertSame(self::PARAMS + ['expand' => $field], $params);
    }

    public function testSetExpandAddedToExistingValue(): void
    {
        $params = self::PARAMS + ['expand' => 'field1'];

        $params = QueryParams::setExpand($params, 'field2');
        $this->assertSame(self::PARAMS + ['expand' => 'field1,field2'], $params);
    }

    public function testSetCorrectMultipleExpands(): void
    {
        $params = self::PARAMS + ['expand' => 'field1'];
        $params = QueryParams::setExpand($params, ['field2', 'field3']);
        $this->assertSame(self::PARAMS + ['expand' => 'field1,field2,field3'], $params);
    }

    public function testSetIncorrectMultipleExpands(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Each expand must be a string');

        QueryParams::setExpand(self::PARAMS, ['field2', false]);
    }

    public function testSetParamAddsToParams(): void
    {
        $params = QueryParams::setParam(self::PARAMS, 'param', false);
        $this->assertSame(self::PARAMS + ['param' => 'false'], $params);
    }

    public function testSetUnknownParamReplacedCurrentParam(): void
    {
        $params = self::PARAMS + ['param3' => 'value1'];

        $params = QueryParams::setParam($params, 'param3', false);
        $this->assertSame(self::PARAMS + ['param3' => 'false'], $params);
    }

    public function testSetKnownAddableParamAddedToExistingParam(): void
    {
        $params = self::PARAMS + ['filter' => 'field1=value1'];

        $params = QueryParams::setParam($params, 'filter', 'field2!=v;alue2');
        $this->assertSame(self::PARAMS + ['filter' => 'field1=value1;field2!=v;alue2'], $params);
    }

    public function testSetKnownParamCaseIndependent(): void
    {
        $params = self::PARAMS + ['expand' => 'field1'];

        $params = QueryParams::setParam($params, 'expand', 'field2');
        $this->assertSame(self::PARAMS + ['expand' => 'field1,field2'], $params);
    }

    public function testSetSingleParamWithoutValueThrowsException(): void
    {
        $param = 'param';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Value can't be null for the key '$param'");

        QueryParams::setParam(self::PARAMS, $param);
    }

    public function testSetCorrectMultipleParams(): void
    {
        $params = self::PARAMS + ['order' => 'field1,desc'];
        $params = QueryParams::setParam($params, [
            ['order', 'field2,asc'],
            ['expand', 'field1'],
            ['expand', 'field2'],
        ]);

        $expectedParams = self::PARAMS + [
            'order' => 'field1,desc;field2,asc',
            'expand' => 'field1,field2',
        ];
        $this->assertSame($expectedParams, $params);
    }

    public function testSetIncorrectMultipleOParams(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Each param must be an array');

        QueryParams::setParam(self::PARAMS, ['field2']);
    }
}
