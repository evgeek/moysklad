<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Currency;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Валют
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-valuta
 *
 * @implements AbstractConcreteCollection<Currency>
 */
class CurrencyCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::CURRENCY,
    ];
    public const TYPE = Type::CURRENCY;
}
