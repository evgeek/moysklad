<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Collections;

use Evgeek\Moysklad\ApiObjects\AutocompleteHelpers\MetaCollection;
use Evgeek\Moysklad\ApiObjects\Objects\Employee;
use stdClass;

/**
 * @property stdClass       $context
 * @property MetaCollection $meta
 * @property Employee[]     $rows
 */
class EmployeeCollection extends AbstractConcreteCollection
{
    public const PATH = [
        'entity',
        'employee',
    ];
    public const TYPE = 'employee';
}
