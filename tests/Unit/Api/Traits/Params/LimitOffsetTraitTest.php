<?php

namespace Evgeek\Tests\Unit\Api\Traits\Params;

use Evgeek\Moysklad\Api\Segments\AbstractSegmentCommon;
use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Traits\Segments\MethodCommonTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/**
 * @covers \Evgeek\Moysklad\Api\AbstractBuilder::setQueryParam
 * @covers \Evgeek\Moysklad\Api\Traits\Params\LimitOffsetTrait
 */
class LimitOffsetTraitTest extends TraitTestCase
{
    public function testSingleLimitFilter(): void
    {
        $params = static::PARAMS + ['limit' => '200'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeLimitOffsetBuilder()
            ->limit(200)
            ->get();
    }

    public function testNewLimitFilterRewritesPrevious(): void
    {
        $params = static::PARAMS + ['limit' => '400'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeLimitOffsetBuilder()
            ->limit(200)
            ->limit(400)
            ->get();
    }

    public function testSingleOffsetFilter(): void
    {
        $params = static::PARAMS + ['offset' => '400'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeLimitOffsetBuilder()
            ->offset(400)
            ->get();
    }

    public function testNewOffsetFilterRewritesPrevious(): void
    {
        $params = static::PARAMS + ['offset' => '500'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeLimitOffsetBuilder()
            ->offset(300)
            ->offset(500)
            ->get();
    }

    private function makeLimitOffsetBuilder()
    {
        return new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends AbstractSegmentCommon {
            use GetTrait;
            use LimitOffsetTrait;
            use MethodCommonTrait;
        };
    }
}
