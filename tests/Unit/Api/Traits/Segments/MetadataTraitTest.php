<?php

namespace Evgeek\Tests\Unit\Api\Traits\Segments;

use Evgeek\Moysklad\Api\Builder;
use Evgeek\Moysklad\Api\Segments\Methods\MethodNamed;
use Evgeek\Moysklad\Api\Segments\Methods\Nested\Metadata;
use Evgeek\Moysklad\Api\Segments\SegmentCommon;
use Evgeek\Moysklad\Api\Traits\Segments\MetadataTrait;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Segments\MetadataTrait */
class MetadataTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends SegmentCommon {
            use MetadataTrait;
        })->metadata();

        $this->assertInstanceOf(Metadata::class, $builder);
        $this->assertInstanceOf(MethodNamed::class, $builder);
        $this->assertInstanceOf(Builder::class, $builder);
    }
}
