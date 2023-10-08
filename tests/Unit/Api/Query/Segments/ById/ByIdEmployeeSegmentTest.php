<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments\ById;

use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdEmployeeSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\SecuritySegment;
use Evgeek\Moysklad\Api\Query\Segments\Special\MassSegmentDelete;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Query\ApiTestCase;

/** @covers \Evgeek\Moysklad\Api\Query\Segments\ById\ByIdEmployeeSegment */
class ByIdEmployeeSegmentTest extends ByIdSegmentTestCase
{
    protected const SEGMENT_CLASS = ByIdEmployeeSegment::class;

    public static function methodsWithSegment(): array
    {
        return [
            ['security', SecuritySegment::class, Segment::SECURITY],
        ];
    }
}
