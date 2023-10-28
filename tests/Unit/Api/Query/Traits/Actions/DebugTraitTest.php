<?php

namespace Evgeek\Tests\Unit\Api\Query\Traits\Actions;

use Evgeek\Moysklad\Api\Query\AbstractBuilder;
use Evgeek\Moysklad\Api\Query\DebugBuilder;
use Evgeek\Moysklad\Api\Query\Segments\AbstractNamedSegment;
use Evgeek\Tests\Unit\Api\Query\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Query\Traits\DebugTrait */
class DebugTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS) extends AbstractNamedSegment {
            protected const SEGMENT = 'test_segment';
        })->debug();

        $this->assertInstanceOf(DebugBuilder::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }
}
