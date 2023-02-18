<?php

namespace Evgeek\Tests\Unit\Api\Traits\Builders;

use Evgeek\Moysklad\Api\Builders\Builder;
use Evgeek\Moysklad\Api\Builders\BuilderCommon;
use Evgeek\Moysklad\Api\Builders\Methods\MethodCommon;
use Evgeek\Moysklad\Api\Traits\Builders\MethodCommonTrait;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Builders\MethodCommonTrait */
class MethodCommonTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends BuilderCommon {
            use MethodCommonTrait;
        })->method('test_method');

        $this->assertInstanceOf(MethodCommon::class, $builder);
        $this->assertInstanceOf(BuilderCommon::class, $builder);
        $this->assertInstanceOf(Builder::class, $builder);
    }
}
