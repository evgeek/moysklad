<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Nested;

use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Objects\Nested\Cashier;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Кассиров
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kassir
 *
 * @implements AbstractNestedCollection<Cashier>
 */
class CashierCollection extends AbstractNestedCollection
{
    public const PATH = [
        Segment::CASHIERS,
    ];
    public const TYPE = Type::CASHIER;
}
