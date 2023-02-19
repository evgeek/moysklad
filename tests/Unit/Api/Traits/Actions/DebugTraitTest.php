<?php

namespace Evgeek\Tests\Unit\Api\Traits\Actions;

use Evgeek\Moysklad\Api\AbstractBuilder;
use Evgeek\Moysklad\Api\Debug;
use Evgeek\Moysklad\Api\Segments\AbstractSegmentNamed;
use Evgeek\Moysklad\Api\Traits\Actions\DebugTrait;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Actions\DebugTrait */
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
