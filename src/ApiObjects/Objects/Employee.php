<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects;

class Employee extends AbstractConcreteObject
{
    public const PATH = [
        'entity',
        'employee',
    ];
    public const TYPE = 'employee';
}
