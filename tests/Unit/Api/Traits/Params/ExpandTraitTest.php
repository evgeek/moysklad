<?php

namespace Evgeek\Tests\Unit\Api\Traits\Params;

use Evgeek\Moysklad\Api\Segments\AbstractSegmentCommon;
use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Traits\Params\ExpandTrait;
use Evgeek\Moysklad\Api\Traits\Segments\MethodCommonTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;
use InvalidArgumentException;

/** @covers \Evgeek\Moysklad\Api\Traits\Params\ExpandTrait */
class ExpandTraitTest extends TraitTestCase
{
    public function testSingleStringExpand(): void
    {
        $params = static::PARAMS + ['expand' => 'expand1'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeExpandBuilder()
            ->expand('expand1')
            ->get();
    }

    public function testSingleStringWithMultipleExpands(): void
    {
        $params = static::PARAMS + ['expand' => 'expand1,expand2'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeExpandBuilder()
            ->expand('expand1,expand2')
            ->get();
    }

    public function testMultipleStringExpands(): void
    {
        $params = static::PARAMS + ['expand' => 'expand1,expand2'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeExpandBuilder()
            ->expand('expand1')
            ->expand('expand2')
            ->get();
    }

    public function testSingleArrayExpand(): void
    {
        $params = static::PARAMS + ['expand' => 'expand1,expand2'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeExpandBuilder()
            ->expand(['expand1', 'expand2'])
            ->get();
    }

    public function testMultipleArrayExpands(): void
    {
        $params = static::PARAMS + ['expand' => 'expand1,expand2,expand3'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeExpandBuilder()
            ->expand(['expand1', 'expand2'])
            ->expand(['expand3'])
            ->get();
    }

    public function testMultipleExpandOfDifferentTypes(): void
    {
        $params = static::PARAMS + ['expand' => 'expand1,expand2,expand3'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeExpandBuilder()
            ->expand(['expand1', 'expand2'])
            ->expand('expand3')
            ->get();
    }

    public function testArrayExpandMustContainsStrings(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Each expand must be a string');

        $this->makeExpandBuilder()
            ->expand(['field1', 1])
            ->get();
    }

    public function testExpandPassedThroughSegments(): void
    {
        $path = [...static::PATH, 'additional_segment'];
        $params = static::PARAMS + ['expand' => 'expand1,expand2,expand3'];
        $this->expectsSendCalledWith(HttpMethod::GET, $path, $params);

        $this->makeExpandBuilder()
            ->expand('expand1')
            ->method('additional_segment')
            ->expand(['expand2', 'expand3'])
            ->get();
    }

    private function makeExpandBuilder()
    {
        return new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends AbstractSegmentCommon {
            use ExpandTrait;
            use GetTrait;
            use MethodCommonTrait;
        };
    }
}
