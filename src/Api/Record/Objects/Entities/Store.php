<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\StoreCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Склад
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sklad
 *
 * @implements AbstractConcreteObject<StoreCollection>
 */
class Store extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::STORE,
    ];
    public const TYPE = Type::STORE;
}
