<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\AccumulationDiscount;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Накопительных скидка
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
 *
 * @implements AbstractConcreteCollection<AccumulationDiscount>
 */
class AccumulationDiscountCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::ACCUMULATIONDISCOUNT,
    ];
    public const TYPE = Type::ACCUMULATIONDISCOUNT;
}
