<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\PersonalDiscount;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Персональных скидок
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
 *
 * @implements AbstractConcreteCollection<PersonalDiscount>
 */
class PersonalDiscountCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PERSONALDISCOUNT,
    ];
    public const TYPE = Type::PERSONALDISCOUNT;
}
