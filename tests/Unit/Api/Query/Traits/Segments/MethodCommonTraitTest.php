<?php

namespace Evgeek\Tests\Unit\Api\Query\Traits\Segments;

use Evgeek\Moysklad\Api\Query\AbstractBuilder;
use Evgeek\Moysklad\Api\Query\Segments\AbstractCommonSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\MethodCommonSegment;
use Evgeek\Tests\Unit\Api\Query\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Query\Traits\Segments\MethodCommonTrait */
class MethodCommonTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends AbstractCommonSegment {
        })->method('test_method');

        $this->assertInstanceOf(MethodCommonSegment::class, $builder);
        $this->assertInstanceOf(AbstractCommonSegment::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }
}
