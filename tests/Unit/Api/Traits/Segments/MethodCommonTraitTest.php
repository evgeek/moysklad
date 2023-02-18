<?php

namespace Evgeek\Tests\Unit\Api\Traits\Segments;

use Evgeek\Moysklad\Api\Builder;
use Evgeek\Moysklad\Api\Segments\Methods\MethodCommon;
use Evgeek\Moysklad\Api\Segments\SegmentCommon;
use Evgeek\Moysklad\Api\Traits\Segments\MethodCommonTrait;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Segments\MethodCommonTrait */
class MethodCommonTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends SegmentCommon {
            use MethodCommonTrait;
        })->method('test_method');

        $this->assertInstanceOf(MethodCommon::class, $builder);
        $this->assertInstanceOf(SegmentCommon::class, $builder);
        $this->assertInstanceOf(Builder::class, $builder);
    }
}
