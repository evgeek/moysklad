<?php

namespace Evgeek\Tests\Unit\Api\Query\Traits\Segments\ById;

use Evgeek\Moysklad\Api\Query\AbstractBuilder;
use Evgeek\Moysklad\Api\Query\Segments\AbstractCommonSegment;
use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdWithPositionsSegment;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdWithPositionsTrait;
use Evgeek\Tests\Unit\Api\Query\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdWithPositionsTrait */
class ByIdWithPositionsTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends AbstractCommonSegment {
            use ByIdWithPositionsTrait;
        })->byId('id');

        $this->assertInstanceOf(ByIdWithPositionsSegment::class, $builder);
        $this->assertInstanceOf(AbstractCommonSegment::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }
}
