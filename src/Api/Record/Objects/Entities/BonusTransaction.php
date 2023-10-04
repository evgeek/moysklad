<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\BonusTransactionCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Бонусная операция
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-bonusnaq-operaciq
 *
 * @implements AbstractConcreteObject<BonusTransactionCollection>
 */
class BonusTransaction extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::BONUSTRANSACTION,
    ];
    public const TYPE = Type::BONUSTRANSACTION;
}
