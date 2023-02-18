<?php

namespace Evgeek\Tests\Unit\Api\Traits\Builders;

use Evgeek\Moysklad\Api\Builders\Builder;
use Evgeek\Moysklad\Api\Builders\BuilderCommon;
use Evgeek\Moysklad\Api\Builders\ById\ByIdPositioned;
use Evgeek\Moysklad\Api\Traits\Builders\ByIdPositionedTrait;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Builders\ByIdPositionedTrait */
class ByIdPositionedTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends BuilderCommon {
            use ByIdPositionedTrait;
        })->byId('id');

        $this->assertInstanceOf(ByIdPositioned::class, $builder);
        $this->assertInstanceOf(BuilderCommon::class, $builder);
        $this->assertInstanceOf(Builder::class, $builder);
    }
}
