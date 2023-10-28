<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments\Methods\Contexts;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Contexts\CompanySettingsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Contexts\PriceTypeSegment;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;
use Evgeek\Tests\Unit\Api\Query\Segments\SegmentTestCase;

/**
 * @covers \Evgeek\Moysklad\Api\Query\Segments\Methods\Contexts\CompanySettingsSegment
 */
class CompanySettingsSegmentTest extends SegmentTestCase
{
    protected string $builderClass = CompanySettingsSegment::class;

    public static function methodsWithCorrespondingSegmentClass(): array
    {
        return [
            Type::PRICETYPE => ['pricetype', Segment::PRICETYPE, PriceTypeSegment::class],
        ];
    }
}
