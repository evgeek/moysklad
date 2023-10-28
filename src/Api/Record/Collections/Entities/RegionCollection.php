<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Region;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Регионов
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-region
 *
 * @implements AbstractConcreteCollection<Region>
 */
class RegionCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::REGION,
    ];
    public const TYPE = Type::REGION;
}
