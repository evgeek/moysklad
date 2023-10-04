<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments\Endpoints;

use Evgeek\Moysklad\Api\Query\Segments\Endpoints\AccountSegmentSettings;
use Evgeek\Moysklad\Api\Query\Segments\Methods\AccountSettings\SubscriptionSegment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * @covers \Evgeek\Moysklad\Api\Query\Segments\Endpoints\AccountSegmentSettings
 */
class AccountSettingsTest extends EndpointTestCase
{
    protected string $builderClass = AccountSegmentSettings::class;

    public static function methodsWithCorrespondingSegmentClass(): array
    {
        return [
            Type::SUBSCRIPTION => ['subscription', SubscriptionSegment::class],
        ];
    }
}
