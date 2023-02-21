<?php

namespace Evgeek\Tests\Unit\Api\Traits\Params;

use Evgeek\Moysklad\Api\Segments\AbstractSegmentCommon;
use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Traits\Params\ParamTrait;
use Evgeek\Moysklad\Api\Traits\Segments\MethodCommonTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;
use InvalidArgumentException;

/**
 * @covers \Evgeek\Moysklad\Api\AbstractBuilder::setQueryParam
 * @covers \Evgeek\Moysklad\Api\Traits\Params\ParamTrait
 */
class ParamTraitTest extends TraitTestCase
{
    public function testSingleUnknownParam(): void
    {
        $params = static::PARAMS + ['param1' => '200'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeParamBuilder()
            ->param('param1', 200)
            ->get();
    }

    public function testMultipleUnknownParam(): void
    {
        $params = static::PARAMS + ['param1' => 'true', 'param2' => 'false'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeParamBuilder()
            ->param('param1', true)
            ->param('param2', false)
            ->get();
    }

    public function testSingleUnknownParamUppercaseConvertsToLowercase(): void
    {
        $params = static::PARAMS + ['param1' => '0'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeParamBuilder()
            ->param('Param1', 0)
            ->get();
    }

    public function testNewUnknownParamRewritesPrevious(): void
    {
        $params = static::PARAMS + ['param1' => 'true'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeParamBuilder()
            ->param('param1', 200.0)
            ->param('Param1', true)
            ->get();
    }

    public function testStringParamWithoutValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Value can't be null for the key 'param'");

        $this->makeParamBuilder()
            ->param('param')
            ->get();
    }

    public function testNewAddableParamAddedToPrevious(): void
    {
        $params = static::PARAMS + ['order' => 'name,desc;updated_at'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeParamBuilder()
            ->param('Order', 'name,desc')
            ->param('order', 'updated_at')
            ->get();
    }

    public function testSingleArrayUnknownParams(): void
    {
        $params = static::PARAMS + ['param1' => '0', 'param2' => '1'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeParamBuilder()
            ->param([
                ['param1', 0],
                ['param2', 1.0],
            ])
            ->get();
    }

    public function testSingleArrayAddableParams(): void
    {
        $params = static::PARAMS + ['order' => 'code;name,desc;updated_at,asc', 'expand' => 'group'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeParamBuilder()
            ->param('order', 'code')
            ->param([
                ['Order', 'name,desc'],
                ['order', 'updated_at,asc'],
            ])
            ->param('expand', 'group')
            ->get();
    }

    public function testArrayParamWithSingleParam(): void
    {
        $params = static::PARAMS + ['param1' => '0', 'param2' => '1', 'param3' => 'value'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeParamBuilder()
            ->param([
                ['param1', 0],
                ['param2', 1.0],
            ])
            ->param('param3', 'value')
            ->get();
    }

    public function testArrayParamWithSameSingleParamReplaced(): void
    {
        $params = static::PARAMS + ['param1' => '0', 'param2' => 'value'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeParamBuilder()
            ->param([
                ['param1', 0],
                ['param2', 1.0],
            ])
            ->param('Param2', 'value')
            ->get();
    }

    public function testArrayParamWithNotArrays(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Each param must be an array');

        $this->makeParamBuilder()
            ->param(['Param2', 'value'])
            ->get();
    }

    public function testParamPassedThroughSegments(): void
    {
        $path = [...static::PATH, 'additional_segment'];
        $params = static::PARAMS + ['order' => 'name,desc;updated_at,asc;code'];
        $this->expectsSendCalledWith(HttpMethod::GET, $path, $params);

        $this->makeParamBuilder()
            ->param([
                ['Order', 'name,desc'],
                ['order', 'updated_at,asc'],
            ])
            ->method('additional_segment')
            ->param('order', 'code')
            ->get();
    }

    public function testParamKeysLowered(): void
    {
        $params = static::PARAMS + ['order' => 'name,desc;CODE', 'limit' => '1'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeParamBuilder()
            ->param([
                ['order', 'name,desc'],
                ['Limit', 1],
            ])
            ->param('OrDeR', 'CODE')
            ->get();
    }

    private function makeParamBuilder()
    {
        return new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends AbstractSegmentCommon {
            use GetTrait;
            use MethodCommonTrait;
            use ParamTrait;
        };
    }
}
