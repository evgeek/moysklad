<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Collections;

use Evgeek\Moysklad\ApiObjects\AutocompleteHelpers\MetaCollection;
use Evgeek\Moysklad\ApiObjects\Objects\Employee;
use Evgeek\Moysklad\ApiObjects\Objects\Product;
use Evgeek\Moysklad\Dictionaries\Endpoint;
use Evgeek\Moysklad\Dictionaries\Entity;
use stdClass;

/**
 * Коллекция сотрудников
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sotrudnik
 *
 * @implements AbstractConcreteCollection<Employee>
 */
class EmployeeCollection extends AbstractConcreteCollection
{
    public const PATH = [
        Endpoint::ENTITY,
        Entity::EMPLOYEE,
    ];
    public const TYPE = Entity::EMPLOYEE;
}
