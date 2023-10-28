<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\Collections\Documents\CounterpartyAdjustmentCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Корректировка баланса контрагента
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-korrektirowka-balansa-kontragenta
 *
 * @implements AbstractConcreteObject<CounterpartyAdjustmentCollection>
 */
class CounterpartyAdjustment extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::COUNTERPARTYADJUSTMENT,
    ];
    public const TYPE = Type::COUNTERPARTYADJUSTMENT;
}
