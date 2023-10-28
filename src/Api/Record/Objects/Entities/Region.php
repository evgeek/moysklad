<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\RegionCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Регион
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-region
 *
 * @implements AbstractConcreteObject<RegionCollection>
 */
class Region extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::REGION,
    ];
    public const TYPE = Type::REGION;
}
