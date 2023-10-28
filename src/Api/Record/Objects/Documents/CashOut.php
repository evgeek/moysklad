<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\CashOutCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Расходный ордер
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-rashodnyj-order
 *
 * @implements AbstractConcreteObject<CashOutCollection>
 */
class CashOut extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::CASHOUT,
    ];
    public const TYPE = Type::CASHOUT;
}
