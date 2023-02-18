<?php

namespace Evgeek\Tests\Unit\Api\Traits\Actions;

use Evgeek\Moysklad\Api\Builder;
use Evgeek\Moysklad\Api\Debug;
use Evgeek\Moysklad\Api\Segments\SegmentNamed;
use Evgeek\Moysklad\Api\Traits\Actions\DebugTrait;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Actions\DebugTrait */
class DebugTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS) extends SegmentNamed {
            use DebugTrait;
            protected const SEGMENT = 'test_segment';
        })->debug();

        $this->assertInstanceOf(Debug::class, $builder);
        $this->assertInstanceOf(Builder::class, $builder);
    }
}
