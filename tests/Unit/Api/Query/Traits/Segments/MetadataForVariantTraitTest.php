<?php

namespace Evgeek\Tests\Unit\Api\Query\Traits\Segments;

use Evgeek\Moysklad\Api\Query\AbstractBuilder;
use Evgeek\Moysklad\Api\Query\Segments\AbstractCommonSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\AbstractMethodNamedSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\AttributesSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\CharacteristicsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\CustomTemplateSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\EmbeddedTemplateSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\FilesSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\ImagesSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\MetadataForVariantSegment;
use Evgeek\Moysklad\Api\Query\Traits\Segments\AttributesTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\CharacteristicsTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\CustomTemplateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\EmbeddedTemplateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\FilesTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ImagesTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\MetadataForVariantTrait;
use Evgeek\Tests\Unit\Api\Query\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Query\Traits\Segments\MetadataForVariantTrait */
class MetadataForVariantTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends AbstractCommonSegment {
            use MetadataForVariantTrait;
        })->metadata();

        $this->assertInstanceOf(MetadataForVariantSegment::class, $builder);
        $this->assertInstanceOf(AbstractMethodNamedSegment::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }
}
