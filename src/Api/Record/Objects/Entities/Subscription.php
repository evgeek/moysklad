<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Подписка компании
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-podpiska-kompanii
 */
class Subscription extends AbstractEntity
{
    public const PATH = [
        Segment::ACCOUNTSETTINGS,
        Segment::SUBSCRIPTION,
    ];
    public const TYPE = Type::SUBSCRIPTION;
}
