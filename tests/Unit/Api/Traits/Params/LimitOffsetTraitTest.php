<?php

namespace Evgeek\Tests\Unit\Api\Traits\Params;

use Evgeek\Moysklad\Api\Segments\AbstractSegmentCommon;
use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Traits\Params\LimitOffsetTrait;
use Evgeek\Moysklad\Api\Traits\Segments\MethodCommonTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Params\LimitOffsetTrait */
class LimitOffsetTraitTest extends TraitTestCase
{
    public function testSingleLimitFilter(): void
    {
        $limit = 200;
        $params = static::PARAMS + ['limit' => $limit];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeLimitOffsetBuilder()
            ->limit($limit)
            ->get();
    }

    public function testNewLimitFilterRewritesPrevious(): void
    {
        $limitOld = 200;
        $limitNew = 400;
        $params = static::PARAMS + ['limit' => $limitNew];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeLimitOffsetBuilder()
            ->limit($limitOld)
            ->limit($limitNew)
            ->get();
    }

    public function testSingleOffsetFilter(): void
    {
        $offset = 400;
        $params = static::PARAMS + ['offset' => $offset];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeLimitOffsetBuilder()
            ->offset($offset)
            ->get();
    }

    public function testNewOffsetFilterRewritesPrevious(): void
    {
        $offsetOld = 400;
        $offsetNew = 500;
        $params = static::PARAMS + ['offset' => $offsetNew];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeLimitOffsetBuilder()
            ->offset($offsetOld)
            ->offset($offsetNew)
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
