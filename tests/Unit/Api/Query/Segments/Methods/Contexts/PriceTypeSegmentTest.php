<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments\Methods\Contexts;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Contexts\PriceTypeSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\DefaultSegment;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Tests\Unit\Api\Query\Segments\SegmentTestCase;

/**
 * @covers \Evgeek\Moysklad\Api\Query\Segments\Methods\Contexts\PriceTypeSegment
 */
class PriceTypeSegmentTest extends SegmentTestCase
{
    protected string $builderClass = PriceTypeSegment::class;

    public static function methodsWithCorrespondingSegmentClass(): array
    {
        return [
            'default' => ['default', Segment::DEFAULT, DefaultSegment::class],
        ];
    }
}
