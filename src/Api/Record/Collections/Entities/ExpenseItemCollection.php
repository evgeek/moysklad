<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\ExpenseItem;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Статей расходов
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-stat-q-rashodow
 *
 * @implements AbstractConcreteCollection<ExpenseItem>
 */
class ExpenseItemCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::EXPENSEITEM,
    ];
    public const TYPE = Type::EXPENSEITEM;
}
