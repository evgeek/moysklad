<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\UomCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Единица измерения
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-edinica-izmereniq
 *
 * @implements AbstractConcreteObject<UomCollection>
 */
class Uom extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::UOM,
    ];
    public const TYPE = Type::UOM;
}
