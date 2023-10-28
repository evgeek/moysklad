<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments\ById;

use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdProcessingPlanSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\MaterialsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\ProductsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\StagesSegment;
use Evgeek\Moysklad\Dictionaries\Segment;

/** @covers \Evgeek\Moysklad\Api\Query\Segments\ById\ByIdProcessingPlanSegment */
class ByIdProcessingPlanSegmentTest extends ByIdSegmentTestCase
{
    protected const SEGMENT_CLASS = ByIdProcessingPlanSegment::class;

    public static function methodsWithSegment(): array
    {
        return [
            ['stages', StagesSegment::class, Segment::STAGES],
            ['materials', MaterialsSegment::class, Segment::MATERIALS],
            ['products', ProductsSegment::class, Segment::PRODUCTS],
        ];
    }
}
