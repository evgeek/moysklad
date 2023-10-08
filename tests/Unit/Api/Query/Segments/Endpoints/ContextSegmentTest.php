<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments\Endpoints;

use Evgeek\Moysklad\Api\Query\Segments\Endpoints\ContextSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Contexts\CompanySettingsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Contexts\PriceTypeSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Contexts\UserSettingsSegment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * @covers \Evgeek\Moysklad\Api\Query\Segments\Endpoints\ContextSegment
 */
class ContextSegmentTest extends EndpointTestCase
{
    protected string $builderClass = ContextSegment::class;

    public static function methodsWithCorrespondingSegmentClass(): array
    {
        return [
            Type::COMPANYSETTINGS => ['companysettings', CompanySettingsSegment::class],
            Type::USERSETTINGS => ['usersettings', UserSettingsSegment::class],
            Type::PRICETYPE => ['pricetype', PriceTypeSegment::class, ['companysettings']],
        ];
    }
}
