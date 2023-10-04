<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\AccumulationDiscountCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Накопительная скидка
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
 *
 * @implements AbstractConcreteObject<AccumulationDiscountCollection>
 */
class AccumulationDiscount extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::ACCUMULATIONDISCOUNT,
    ];
    public const TYPE = Type::ACCUMULATIONDISCOUNT;
}
