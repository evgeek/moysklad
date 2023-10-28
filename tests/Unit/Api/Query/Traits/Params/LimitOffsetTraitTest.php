<?php

namespace Evgeek\Tests\Unit\Api\Query\Traits\Params;

use Evgeek\Moysklad\Api\Query\Segments\AbstractCommonSegment;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Query\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Query\Traits\Params\LimitOffsetTrait */
class LimitOffsetTraitTest extends TraitTestCase
{
    public function testSingleLimit(): void
    {
        $params = static::PARAMS + ['limit' => '200'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeLimitOffsetBuilder()
            ->limit(200)
            ->get();
    }

    public function testNewLimitRewritesPrevious(): void
    {
        $params = static::PARAMS + ['limit' => '400'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeLimitOffsetBuilder()
            ->limit(200)
            ->limit(400)
            ->get();
    }

    public function testSingleOffset(): void
    {
        $params = static::PARAMS + ['offset' => '400'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeLimitOffsetBuilder()
            ->offset(400)
            ->get();
    }

    public function testNewOffsetRewritesPrevious(): void
    {
        $params = static::PARAMS + ['offset' => '500'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeLimitOffsetBuilder()
            ->offset(300)
            ->offset(500)
            ->get();
    }

    public function testLimitOffsetPassedThroughSegments(): void
    {
        $path = [...static::PATH, 'additional_segment'];
        $params = static::PARAMS + [
            'limit' => '200',
            'offset' => '300',
        ];
        $this->expectsSendCalledWith(HttpMethod::GET, $path, $params);

        $this->makeLimitOffsetBuilder()
            ->limit(200)
            ->offset(300)
            ->method('additional_segment')
            ->get();
    }

    private function makeLimitOffsetBuilder()
    {
        return new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends AbstractCommonSegment {
        };
    }
}
