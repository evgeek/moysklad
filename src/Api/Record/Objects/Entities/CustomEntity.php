<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\CustomEntityCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Пользовательский справочник
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-pol-zowatel-skij-sprawochnik
 *
 * @implements AbstractConcreteObject<CustomEntityCollection>
 */
class CustomEntity extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::CUSTOMENTITY,
    ];
    public const TYPE = Type::CUSTOMENTITY;
}
