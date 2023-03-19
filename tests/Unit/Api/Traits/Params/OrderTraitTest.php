<?php

namespace Evgeek\Tests\Unit\Api\Traits\Params;

use Evgeek\Moysklad\Api\Segments\AbstractSegmentCommon;
use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Traits\Params\OrderTrait;
use Evgeek\Moysklad\Api\Traits\Segments\MethodCommonTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Enums\OrderDirection;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;
use InvalidArgumentException;

/** @covers \Evgeek\Moysklad\Api\Traits\Params\OrderTrait */
class OrderTraitTest extends TraitTestCase
{
    public function testSingleStringOrderWithDefaultSortOrder(): void
    {
        $params = static::PARAMS + ['order' => 'field1,asc'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeOrderBuilder()
            ->order('field1')
            ->get();
    }

    public function testSingleStringOrderWithStringSortOrder(): void
    {
        $params = static::PARAMS + ['order' => 'field1,desc'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeOrderBuilder()
            ->order('field1', 'desc')
            ->get();
    }

    public function testSingleStringOrderWithEnumSortOrder(): void
    {
        $params = static::PARAMS + ['order' => 'field1,asc'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeOrderBuilder()
            ->order('field1', OrderDirection::ASC)
            ->get();
    }

    public function testMultipleStringOrder(): void
    {
        $params = static::PARAMS + ['order' => 'field1,asc;field2,desc'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeOrderBuilder()
            ->order('field1')
            ->order('field2', OrderDirection::DESC)
            ->get();
    }

    public function testSingleArrayOrder(): void
    {
        $params = static::PARAMS + ['order' => 'field1,desc;field2,asc'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeOrderBuilder()
            ->order([
                ['field1', OrderDirection::DESC],
                ['field2'],
            ])
            ->get();
    }

    public function testArrayAndNotArrayOrdersTogether(): void
    {
        $params = static::PARAMS + ['order' => 'field1,asc;field2,desc;field3,asc'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeOrderBuilder()
            ->order([
                ['field1', 'asc'],
                ['field2', OrderDirection::DESC],
            ])
            ->order('field3')
            ->get();
    }

    public function testArrayOrderMustContainsArrays(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Each order must be an array');

        $this->makeOrderBuilder()
            ->order(['field1', 'asc'])
            ->get();
    }

    public function testOrderPassedThroughSegments(): void
    {
        $path = [...static::PATH, 'additional_segment'];
        $params = static::PARAMS + ['order' => 'field1,desc;field2,asc;field3,asc'];
        $this->expectsSendCalledWith(HttpMethod::GET, $path, $params);

        $this->makeOrderBuilder()
            ->order('field1', 'desc')
            ->method('additional_segment')
            ->order([
                ['field2', OrderDirection::ASC],
                ['field3'],
            ])
            ->get();
    }

    private function makeOrderBuilder()
    {
        return new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends AbstractSegmentCommon {
            use GetTrait;
            use MethodCommonTrait;
            use OrderTrait;
        };
    }
}
