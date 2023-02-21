<?php

namespace Evgeek\Tests\Unit\Api\Traits\Segments;

use Evgeek\Moysklad\Api\AbstractBuilder;
use Evgeek\Moysklad\Api\Segments\AbstractSegmentCommon;
use Evgeek\Moysklad\Api\Segments\Methods\AbstractMethodNamed;
use Evgeek\Moysklad\Api\Segments\Methods\Nested\Attributes;
use Evgeek\Moysklad\Api\Traits\Segments\AttributesTrait;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Segments\AttributesTrait */
class AttributesTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends AbstractSegmentCommon {
            use AttributesTrait;
        })->attributes();

        $this->assertInstanceOf(Attributes::class, $builder);
        $this->assertInstanceOf(AbstractMethodNamed::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }
}