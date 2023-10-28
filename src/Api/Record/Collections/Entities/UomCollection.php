<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Uom;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Единиц измерения
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-edinica-izmereniq
 *
 * @implements AbstractConcreteCollection<Uom>
 */
class UomCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::UOM,
    ];
    public const TYPE = Type::UOM;
}
