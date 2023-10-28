<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments\Methods\Entities;

use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\AssortmentSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\SettingsSegment;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Tests\Unit\Api\Query\Segments\SegmentTestCase;

/**
 * @covers \Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\AssortmentSegment
 */
class AssortmentSegmentTest extends SegmentTestCase
{
    protected string $builderClass = AssortmentSegment::class;

    public static function methodsWithCorrespondingSegmentClass(): array
    {
        return [
            'default' => ['settings', Segment::SETTINGS, SettingsSegment::class],
        ];
    }
}
