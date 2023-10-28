<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\CustomEntity;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Пользовательских справочников
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-pol-zowatel-skij-sprawochnik
 *
 * @implements AbstractConcreteCollection<CustomEntity>
 */
class CustomEntityCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::CUSTOMENTITY,
    ];
    public const TYPE = Type::CUSTOMENTITY;
}
