<?php

namespace Evgeek\Tests\Unit\Api\Traits\Builders;

use Evgeek\Moysklad\Api\Builders\Builder;
use Evgeek\Moysklad\Api\Builders\BuilderCommon;
use Evgeek\Moysklad\Api\Builders\ById\ByIdCommon;
use Evgeek\Moysklad\Api\Traits\Builders\ByIdCommonTrait;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Builders\ByIdCommonTrait */
class ByIdCommonTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends BuilderCommon {
            use ByIdCommonTrait;
        })->byId('id');

        $this->assertInstanceOf(ByIdCommon::class, $builder);
        $this->assertInstanceOf(BuilderCommon::class, $builder);
        $this->assertInstanceOf(Builder::class, $builder);
    }
}
