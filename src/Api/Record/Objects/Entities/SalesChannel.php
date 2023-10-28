<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\SalesChannelCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Канал продаж
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kanal-prodazh
 *
 * @implements AbstractConcreteObject<SalesChannelCollection>
 */
class SalesChannel extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::SALESCHANNEL,
    ];
    public const TYPE = Type::SALESCHANNEL;
}
