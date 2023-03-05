<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Collections;

use Evgeek\Moysklad\ApiObjects\Meta\MetaCollection;
use Evgeek\Moysklad\ApiObjects\Objects\Employee;
use stdClass;

/**
 * @property stdClass       $context
 * @property MetaCollection $meta
 * @property Employee[]     $rows
 */
class EmployeeCollection extends AbstractCollection
{
}
