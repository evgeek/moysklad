<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments\ById;

use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdOrganizationSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\AccountsSegment;
use Evgeek\Moysklad\Dictionaries\Segment;

/** @covers \Evgeek\Moysklad\Api\Query\Segments\ById\ByIdOrganizationSegment */
class ByIdOrganizationSegmentTest extends ByIdSegmentTestCase
{
    protected const SEGMENT_CLASS = ByIdOrganizationSegment::class;

    public static function methodsWithSegment(): array
    {
        return [
            ['accounts', AccountsSegment::class, Segment::ACCOUNTS],
        ];
    }
}
