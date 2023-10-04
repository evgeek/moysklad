<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\CustomRole;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Пользовательских ролей
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-pol-zowatel-skie-roli
 *
 * @implements AbstractConcreteCollection<CustomRole>
 */
class CustomRoleCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::ROLE,
    ];
    public const TYPE = Type::CUSTOMROLE;
}
