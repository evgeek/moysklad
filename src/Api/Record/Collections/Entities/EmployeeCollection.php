<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Employee;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Сотрудников
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sotrudnik
 *
 * @implements AbstractConcreteCollection<Employee>
 */
class EmployeeCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::EMPLOYEE,
    ];
    public const TYPE = Type::EMPLOYEE;
}
