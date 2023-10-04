<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Nested;

use Evgeek\Moysklad\Api\Record\Collections\Nested\CashierCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractNestedObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Кассир
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kassir
 *
 * @implements AbstractNestedObject<CashierCollection>
 */
class Cashier extends AbstractNestedObject
{
    public const PATH = [
        Segment::CASHIERS,
    ];
    public const TYPE = Type::CASHIER;
}
