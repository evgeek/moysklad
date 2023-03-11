<?php

namespace Evgeek\Tests\Unit\Api\Traits\Segments;

use Evgeek\Moysklad\Api\AbstractBuilder;
use Evgeek\Moysklad\Api\Segments\AbstractSegmentCommon;
use Evgeek\Moysklad\Api\Segments\ById\ByIdSegmentPositioned;
use Evgeek\Moysklad\Api\Traits\Segments\ByIdPositionedTrait;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Segments\ByIdPositionedTrait */
class ByIdPositionedTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends AbstractSegmentCommon {
            use ByIdPositionedTrait;
        })->byId('id');

        $this->assertInstanceOf(ByIdSegmentPositioned::class, $builder);
        $this->assertInstanceOf(AbstractSegmentCommon::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }
}
