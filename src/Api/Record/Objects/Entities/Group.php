<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\GroupCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Отдел
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-otdel
 *
 * @implements AbstractConcreteObject<GroupCollection>
 */
class Group extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::GROUP,
    ];
    public const TYPE = Type::GROUP;
}
