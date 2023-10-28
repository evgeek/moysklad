<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Variant;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Модификаций
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-modifikaciq
 *
 * @implements AbstractConcreteCollection<Variant>
 */
class VariantCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::VARIANT,
    ];
    public const TYPE = Type::VARIANT;
}
