<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\RetailStore;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Точек продаж
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tochka-prodazh
 *
 * @implements AbstractConcreteCollection<RetailStore>
 */
class RetailStoreCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::RETAILSTORE,
    ];
    public const TYPE = Type::RETAILSTORE;
}
