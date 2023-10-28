<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments\ById;

use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdCommissionReportInSegment;
use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdEmployeeSegment;
use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdProcessingSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\ProcessingPositionMaterialSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\ProcessingPositionResultSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\ReturnToCommissionerPositionsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\SecuritySegment;
use Evgeek\Moysklad\Api\Query\Segments\Special\MassSegmentDelete;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Query\ApiTestCase;

/** @covers \Evgeek\Moysklad\Api\Query\Segments\ById\ByIdProcessingSegment */
class ByIdProcessingSegmentTest extends ByIdSegmentTestCase
{
    protected const SEGMENT_CLASS = ByIdProcessingSegment::class;

    public static function methodsWithSegment(): array
    {
        return [
            ['materials', ProcessingPositionMaterialSegment::class, Segment::MATERIALS],
            ['products', ProcessingPositionResultSegment::class, Segment::PRODUCTS],
        ];
    }
}
