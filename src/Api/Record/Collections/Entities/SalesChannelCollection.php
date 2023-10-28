<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\SalesChannel;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Каналов продаж
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kanal-prodazh
 *
 * @implements AbstractConcreteCollection<SalesChannel>
 */
class SalesChannelCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::SALESCHANNEL,
    ];
    public const TYPE = Type::SALESCHANNEL;
}
