<?php

namespace Evgeek\Tests\Unit\Api\Query\Traits\Segments\ById;

use Evgeek\Moysklad\Api\Query\AbstractBuilder;
use Evgeek\Moysklad\Api\Query\Segments\AbstractCommonSegment;
use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdProcessingSegment;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdProcessingTrait;
use Evgeek\Tests\Unit\Api\Query\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdProcessingTrait */
class ByIdProcessingTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS, static::SEGMENT) extends AbstractCommonSegment {
            use ByIdProcessingTrait;
        })
            ->byId('id');

        $this->assertInstanceOf(ByIdProcessingSegment::class, $builder);
        $this->assertInstanceOf(AbstractCommonSegment::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }
}
