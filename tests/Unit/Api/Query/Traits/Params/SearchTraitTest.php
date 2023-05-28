<?php

namespace Evgeek\Tests\Unit\Api\Query\Traits\Params;

use Evgeek\Moysklad\Api\Query\Segments\AbstractSegmentCommon;
use Evgeek\Moysklad\Api\Query\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Query\Traits\Params\SearchTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\MethodCommonTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Query\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Query\Traits\Params\SearchTrait */
class SearchTraitTest extends TraitTestCase
{
    public function testSingleSearch(): void
    {
        $params = static::PARAMS + ['search' => 'text'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeSearchBuilder()
            ->search('text')
            ->get();
    }

    public function testNewSearchRewritesPrevious(): void
    {
        $params = static::PARAMS + ['search' => 'text2'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeSearchBuilder()
            ->search('text1')
            ->search('text2')
            ->get();
    }

    public function testSearchPassedThroughSegments(): void
    {
        $path = [...static::PATH, 'additional_segment'];
        $params = static::PARAMS + ['search' => 'text'];
        $this->expectsSendCalledWith(HttpMethod::GET, $path, $params);

        $this->makeSearchBuilder()
            ->search('text')
            ->method('additional_segment')
            ->get();
    }

    private function makeSearchBuilder()
    {
        return new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends AbstractSegmentCommon {
            use GetTrait;
            use MethodCommonTrait;
            use SearchTrait;
        };
    }
}
