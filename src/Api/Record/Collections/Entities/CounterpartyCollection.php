<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Counterparty;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Контрагентов
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kontragent
 *
 * @implements AbstractConcreteCollection<Counterparty>
 */
class CounterpartyCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::COUNTERPARTY,
    ];
    public const TYPE = Type::COUNTERPARTY;
}
