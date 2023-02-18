<?php

namespace Evgeek\Tests\Unit\Api\Traits\Segments;

use Evgeek\Moysklad\Api\Builder;
use Evgeek\Moysklad\Api\Segments\ById\ByIdCommon;
use Evgeek\Moysklad\Api\Segments\SegmentCommon;
use Evgeek\Moysklad\Api\Traits\Segments\ByIdCommonTrait;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Segments\ByIdCommonTrait */
class ByIdCommonTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends SegmentCommon {
            use ByIdCommonTrait;
        })->byId('id');

        $this->assertInstanceOf(ByIdCommon::class, $builder);
        $this->assertInstanceOf(SegmentCommon::class, $builder);
        $this->assertInstanceOf(Builder::class, $builder);
    }
}
