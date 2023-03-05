<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects;

class Employee extends AbstractConcreteObject
{
    protected const PATH = [
        'entity',
        'employee',
    ];
    protected const TYPE = 'employee';
}
