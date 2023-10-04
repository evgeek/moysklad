<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\SpecialPriceDiscount;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Специальных цен
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
 *
 * @implements AbstractConcreteCollection<SpecialPriceDiscount>
 */
class SpecialPriceDiscountCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::SPECIALPRICEDISCOUNT,
    ];
    public const TYPE = Type::SPECIALPRICEDISCOUNT;
}
