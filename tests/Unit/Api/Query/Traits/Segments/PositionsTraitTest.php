<?php

namespace Evgeek\Tests\Unit\Api\Query\Traits\Segments;

use Evgeek\Moysklad\Api\Query\AbstractBuilder;
use Evgeek\Moysklad\Api\Query\Segments\AbstractCommonSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\AbstractMethodNamedSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\PositionsSegment;
use Evgeek\Moysklad\Api\Query\Traits\Segments\PositionsTrait;
use Evgeek\Tests\Unit\Api\Query\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Query\Traits\Segments\PositionsTrait */
class PositionsTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends AbstractCommonSegment {
            use PositionsTrait;
        })->positions();

        $this->assertInstanceOf(PositionsSegment::class, $builder);
        $this->assertInstanceOf(AbstractMethodNamedSegment::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }
}
