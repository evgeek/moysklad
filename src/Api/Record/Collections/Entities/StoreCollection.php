<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Store;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Складов
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sklad
 *
 * @implements AbstractConcreteCollection<Store>
 */
class StoreCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::STORE,
    ];
    public const TYPE = Type::STORE;
}
