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
use Evgeek\Moysklad\Api\Query\Traits\Segments\AttributesTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\CharacteristicsTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\CustomTemplateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\EmbeddedTemplateTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\FilesTrait;
use Evgeek\Tests\Unit\Api\Query\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Query\Traits\Segments\FilesTrait */
class FilesTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends AbstractCommonSegment {
            use FilesTrait;
        })->files();

        $this->assertInstanceOf(FilesSegment::class, $builder);
        $this->assertInstanceOf(AbstractMethodNamedSegment::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }
}