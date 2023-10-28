<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\BonusTransaction;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Бонусных операций
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-bonusnaq-operaciq
 *
 * @implements AbstractConcreteCollection<BonusTransaction>
 */
class BonusTransactionCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::BONUSTRANSACTION,
    ];
    public const TYPE = Type::BONUSTRANSACTION;
}
