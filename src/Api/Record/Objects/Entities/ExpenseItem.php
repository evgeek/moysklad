<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\ExpenseItemCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Статья расходов
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-stat-q-rashodow
 *
 * @implements AbstractConcreteObject<ExpenseItemCollection>
 */
class ExpenseItem extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::EXPENSEITEM,
    ];
    public const TYPE = Type::EXPENSEITEM;
}
