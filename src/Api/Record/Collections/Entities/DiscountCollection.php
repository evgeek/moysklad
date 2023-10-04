<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\AccumulationDiscount;
use Evgeek\Moysklad\Api\Record\Objects\Entities\PersonalDiscount;
use Evgeek\Moysklad\Api\Record\Objects\Entities\SpecialPriceDiscount;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Скидок
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
 *
 * @implements AbstractConcreteCollection<AccumulationDiscount>
 * @implements AbstractConcreteCollection<PersonalDiscount>
 * @implements AbstractConcreteCollection<SpecialPriceDiscount>
 */
class DiscountCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::DISCOUNT,
    ];
    public const TYPE = Type::DISCOUNT;
}
