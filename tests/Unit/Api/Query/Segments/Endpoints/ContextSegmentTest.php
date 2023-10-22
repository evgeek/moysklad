<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments\Endpoints;

use Evgeek\Moysklad\Api\Query\Segments\Endpoints\ContextSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Contexts\CompanySettingsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Contexts\PriceTypeSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Contexts\UserSettingsSegment;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;
use Evgeek\Tests\Unit\Api\Query\Segments\SegmentTestCase;

/**
 * @covers \Evgeek\Moysklad\Api\Query\Segments\Endpoints\ContextSegment
 */
class ContextSegmentTest extends SegmentTestCase
{
    protected string $builderClass = ContextSegment::class;

    public static function methodsWithCorrespondingSegmentClass(): array
    {
        return [
            Type::COMPANYSETTINGS => ['companysettings', Segment::COMPANYSETTINGS, CompanySettingsSegment::class],
            Type::USERSETTINGS => ['usersettings', Segment::USERSETTINGS, UserSettingsSegment::class],
            Type::PRICETYPE => ['pricetype', Segment::PRICETYPE, PriceTypeSegment::class, ['companysettings']],
        ];
    }
}
