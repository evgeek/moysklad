<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Endpoints;

use Evgeek\Moysklad\Api\Query\Segments\AbstractNamedSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\AccountSettings\SubscriptionSegment;
use Evgeek\Moysklad\Dictionaries\Segment;

class AccountSettingsSegment extends AbstractNamedSegment
{
    protected const SEGMENT = Segment::ACCOUNTSETTINGS;

    /**
     * Подписка компании
     *
     * <code>
     * $subscription = $ms->query()
     *  ->accountSettings()
     *  ->subscription()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-podpiska-kompanii
     */
    public function subscription(): SubscriptionSegment
    {
        return $this->resolveNamedBuilder(SubscriptionSegment::class);
    }
}
