<?php

namespace Evgeek\Tests\Unit\Api\Traits\Actions;

use Evgeek\Moysklad\Api\Builders\Builder;
use Evgeek\Moysklad\Api\Builders\BuilderNamed;
use Evgeek\Moysklad\Api\Builders\Methods\Special\Debug;
use Evgeek\Moysklad\Api\Traits\Actions\DebugTrait;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Actions\DebugTrait */
class DebugTraitTest extends TraitTestCase
{
    public function testCreate(): void
    {
        $builder = new class($this->api, static::PREV_PATH, static::PARAMS) extends BuilderNamed {
            use DebugTrait;
            protected const NAME = 'test_segment';
        };
        $debug = $builder->debug();

        $this->assertInstanceOf(Debug::class, $debug);
        $this->assertInstanceOf(Builder::class, $debug);
    }
}
