<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Country;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Стран
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-strana
 *
 * @implements AbstractConcreteCollection<Country>
 */
class CountryCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::COUNTRY,
    ];
    public const TYPE = Type::COUNTRY;
}
