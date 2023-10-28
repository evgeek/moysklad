<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments\ById;

use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdCommissionReportInSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\ReturnToCommissionerPositionsSegment;
use Evgeek\Moysklad\Dictionaries\Segment;

/** @covers \Evgeek\Moysklad\Api\Query\Segments\ById\ByIdCommissionReportInSegment */
class ByIdCommissionReportInSegmentTest extends ByIdSegmentTestCase
{
    protected const SEGMENT_CLASS = ByIdCommissionReportInSegment::class;

    public static function methodsWithSegment(): array
    {
        return [
            ['returntocommissionerpositions', ReturnToCommissionerPositionsSegment::class, Segment::RETURNTOCOMMISSIONERPOSITIONS],
        ];
    }
}
