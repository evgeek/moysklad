<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments\Endpoints;

use Evgeek\Moysklad\Api\Query\Segments\Endpoints\AccountSettingsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\AccountSettings\SubscriptionSegment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * @covers \Evgeek\Moysklad\Api\Query\Segments\Endpoints\AccountSettingsSegment
 */
class AccountSettingsSegmentTest extends EndpointTestCase
{
    protected string $builderClass = AccountSettingsSegment::class;

    public static function methodsWithCorrespondingSegmentClass(): array
    {
        return [
            Type::SUBSCRIPTION => ['subscription', SubscriptionSegment::class],
        ];
    }
}
