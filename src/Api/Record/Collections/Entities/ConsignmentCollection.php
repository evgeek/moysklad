<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Consignment;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Серий
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-seriq
 *
 * @implements AbstractConcreteCollection<Consignment>
 */
class ConsignmentCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::CONSIGNMENT,
    ];
    public const TYPE = Type::CONSIGNMENT;
}
