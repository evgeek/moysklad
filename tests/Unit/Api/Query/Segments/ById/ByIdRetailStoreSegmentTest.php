<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments\ById;

use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdRetailStoreSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\CashiersSegment;
use Evgeek\Moysklad\Dictionaries\Segment;

/** @covers \Evgeek\Moysklad\Api\Query\Segments\ById\ByIdRetailStoreSegment */
class ByIdRetailStoreSegmentTest extends ByIdSegmentTestCase
{
    protected const SEGMENT_CLASS = ByIdRetailStoreSegment::class;

    public static function methodsWithSegment(): array
    {
        return [
            ['cashiers', CashiersSegment::class, Segment::CASHIERS],
        ];
    }
}
