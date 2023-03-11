<?php

namespace Evgeek\Tests\Unit\Api\Traits\Segments;

use Evgeek\Moysklad\Api\AbstractBuilder;
use Evgeek\Moysklad\Api\Segments\AbstractSegmentCommon;
use Evgeek\Moysklad\Api\Segments\Methods\MethodSegmentCommon;
use Evgeek\Moysklad\Api\Traits\Segments\MethodCommonTrait;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Segments\MethodCommonTrait */
class MethodCommonTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends AbstractSegmentCommon {
            use MethodCommonTrait;
        })->method('test_method');

        $this->assertInstanceOf(MethodSegmentCommon::class, $builder);
        $this->assertInstanceOf(AbstractSegmentCommon::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }
}
