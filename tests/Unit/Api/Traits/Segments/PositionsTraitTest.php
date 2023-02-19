<?php

namespace Evgeek\Tests\Unit\Api\Traits\Segments;

use Evgeek\Moysklad\Api\AbstractBuilder;
use Evgeek\Moysklad\Api\Segments\AbstractSegmentCommon;
use Evgeek\Moysklad\Api\Segments\Methods\AbstractMethodNamed;
use Evgeek\Moysklad\Api\Segments\Methods\Nested\Positions;
use Evgeek\Moysklad\Api\Traits\Segments\PositionsTrait;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Segments\PositionsTrait */
class PositionsTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends AbstractSegmentCommon {
            use PositionsTrait;
        })->positions();

        $this->assertInstanceOf(Positions::class, $builder);
        $this->assertInstanceOf(AbstractMethodNamed::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }
}
