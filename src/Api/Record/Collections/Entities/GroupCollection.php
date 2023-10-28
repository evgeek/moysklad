<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Group;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Отделов
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-otdel
 *
 * @implements AbstractConcreteCollection<Group>
 */
class GroupCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::GROUP,
    ];
    public const TYPE = Type::GROUP;
}
