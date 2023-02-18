<?php

namespace Evgeek\Tests\Unit\Api\Traits\Builders;

use Evgeek\Moysklad\Api\Builders\Builder;
use Evgeek\Moysklad\Api\Builders\BuilderCommon;
use Evgeek\Moysklad\Api\Builders\Methods\MethodNamed;
use Evgeek\Moysklad\Api\Builders\Methods\Nested\Positions;
use Evgeek\Moysklad\Api\Traits\Builders\PositionsTrait;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Builders\PositionsTrait */
class PositionsTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends BuilderCommon {
            use PositionsTrait;
        })->positions();

        $this->assertInstanceOf(Positions::class, $builder);
        $this->assertInstanceOf(MethodNamed::class, $builder);
        $this->assertInstanceOf(Builder::class, $builder);
    }
}
