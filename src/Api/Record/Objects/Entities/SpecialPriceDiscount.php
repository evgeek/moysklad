<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\SpecialPriceDiscountCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Специальная цена
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
 *
 * @implements AbstractConcreteObject<SpecialPriceDiscountCollection>
 */
class SpecialPriceDiscount extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::SPECIALPRICEDISCOUNT,
    ];
    public const TYPE = Type::SPECIALPRICEDISCOUNT;
}
