<?php

namespace Evgeek\Tests\Unit\Api\Query\Traits\Actions;

use Evgeek\Moysklad\Api\Query\AbstractBuilder;
use Evgeek\Moysklad\Api\Query\Debug;
use Evgeek\Moysklad\Api\Query\Segments\AbstractSegmentNamed;
use Evgeek\Moysklad\Api\Query\Traits\Actions\DebugTrait;
use Evgeek\Tests\Unit\Api\Query\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Query\Traits\Actions\DebugTrait */
class DebugTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS) extends AbstractSegmentNamed {
            use DebugTrait;

            protected const SEGMENT = 'test_segment';
        })->debug();

        $this->assertInstanceOf(Debug::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }
}
