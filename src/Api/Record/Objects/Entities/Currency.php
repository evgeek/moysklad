<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\CurrencyCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Валюта
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-valuta
 *
 * @implements AbstractConcreteObject<CurrencyCollection>
 */
class Currency extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::CURRENCY,
    ];
    public const TYPE = Type::CURRENCY;
}
