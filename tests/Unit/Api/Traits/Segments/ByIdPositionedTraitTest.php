<?php

namespace Evgeek\Tests\Unit\Api\Traits\Segments;

use Evgeek\Moysklad\Api\Builder;
use Evgeek\Moysklad\Api\Segments\ById\ByIdPositioned;
use Evgeek\Moysklad\Api\Segments\SegmentCommon;
use Evgeek\Moysklad\Api\Traits\Segments\ByIdPositionedTrait;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Segments\ByIdPositionedTrait */
class ByIdPositionedTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends SegmentCommon {
            use ByIdPositionedTrait;
        })->byId('id');

        $this->assertInstanceOf(ByIdPositioned::class, $builder);
        $this->assertInstanceOf(SegmentCommon::class, $builder);
        $this->assertInstanceOf(Builder::class, $builder);
    }
}
