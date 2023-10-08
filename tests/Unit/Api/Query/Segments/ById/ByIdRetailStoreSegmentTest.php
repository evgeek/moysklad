<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments\ById;

use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdEmployeeSegment;
use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdOrganizationSegment;
use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdProcessingPlanSegment;
use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdRetailStoreSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ProcessingPlanSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\AccountsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\CashiersSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\MaterialsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\ProductsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\StagesSegment;
use Evgeek\Moysklad\Api\Query\Segments\Special\MassSegmentDelete;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Query\ApiTestCase;

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
