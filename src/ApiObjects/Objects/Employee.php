<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects;

use Evgeek\Moysklad\Dictionaries\Endpoint;
use Evgeek\Moysklad\Dictionaries\Entity;

class Employee extends AbstractConcreteObject
{
    public const PATH = [
        Endpoint::ENTITY,
        Entity::EMPLOYEE,
    ];
    public const TYPE = Entity::EMPLOYEE;
}
