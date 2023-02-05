<?php

namespace Evgeek\Tests\Unit\Api\Traits\Actions;

use Evgeek\Moysklad\Api\Builders\Builder;
use Evgeek\Moysklad\Api\Builders\Methods\Special\Debug;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Actions\DebugTrait */
class DebugTraitTest extends TraitTestCase
{
    public function testCreate(): void
    {
        $debug = $this->builder->debug();

        $this->assertInstanceOf(Debug::class, $debug);
        $this->assertInstanceOf(Builder::class, $debug);
    }
}
