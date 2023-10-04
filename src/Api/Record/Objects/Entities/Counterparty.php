<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\CounterpartyCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Контрагент
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kontragent
 *
 * @implements AbstractConcreteObject<CounterpartyCollection>
 */
class Counterparty extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::COUNTERPARTY,
    ];
    public const TYPE = Type::COUNTERPARTY;
}
