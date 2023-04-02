<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Builders;

use Evgeek\Moysklad\ApiObjects\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\ApiObjects\Objects\Employee;
use Evgeek\Moysklad\ApiObjects\Objects\Product;

class SingleObjectBuilder extends AbstractObjectBuilder
{
    /** @return Product */
    public function product(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Product::TYPE, $content);
    }

    /** @return Employee */
    public function employee(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Employee::TYPE, $content);
    }
}
