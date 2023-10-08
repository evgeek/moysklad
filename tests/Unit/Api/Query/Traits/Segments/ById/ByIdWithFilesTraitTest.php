<?php

namespace Evgeek\Tests\Unit\Api\Query\Traits\Segments\ById;

use Evgeek\Moysklad\Api\Query\AbstractBuilder;
use Evgeek\Moysklad\Api\Query\Segments\AbstractCommonSegment;
use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdBundleSegment;
use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdEmployeeSegment;
use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdOrganizationSegment;
use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdWithFilesSegment;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdBundleTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdEmployeeTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdOrganizationTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdProductTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdVariantTrait;
use Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdWithFilesTrait;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Query\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Query\Traits\Segments\ById\ByIdWithFilesTrait */
class ByIdWithFilesTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS, static::SEGMENT) extends AbstractCommonSegment {
            use ByIdWithFilesTrait;
        })
            ->byId('id');

        $this->assertInstanceOf(ByIdWithFilesSegment::class, $builder);
        $this->assertInstanceOf(AbstractCommonSegment::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }
}
