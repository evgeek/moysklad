<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments\Endpoints;

use Evgeek\Moysklad\Api\Query\Segments\Endpoints\AccountSettingsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\AccountSettings\SubscriptionSegment;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;
use Evgeek\Tests\Unit\Api\Query\Segments\SegmentTestCase;

/**
 * @covers \Evgeek\Moysklad\Api\Query\Segments\Endpoints\AccountSettingsSegment
 */
class AccountSettingsSegmentTest extends SegmentTestCase
{
    protected string $builderClass = AccountSettingsSegment::class;

    public static function methodsWithCorrespondingSegmentClass(): array
    {
        return [
            Type::SUBSCRIPTION => ['subscription', Segment::SUBSCRIPTION, SubscriptionSegment::class],
        ];
    }
}
