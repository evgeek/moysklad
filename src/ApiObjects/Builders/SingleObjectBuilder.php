<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Builders;

use Evgeek\Moysklad\ApiObjects\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\ApiObjects\Objects\Documents\Customerorder;
use Evgeek\Moysklad\ApiObjects\Objects\Entities\Employee;
use Evgeek\Moysklad\ApiObjects\Objects\Entities\Product;
use Evgeek\Moysklad\ApiObjects\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Document;
use Evgeek\Moysklad\Dictionaries\Entity;

class SingleObjectBuilder extends AbstractObjectBuilder
{
    /** @return Product */
    public function product(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Entity::PRODUCT, $content);
    }

    /** @return Employee */
    public function employee(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Entity::EMPLOYEE, $content);
    }

    /** @return Customerorder */
    public function customerorder(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Document::CUSTOMERORDER, $content);
    }

    public function unknown(array $path, string $type, mixed $content = []): UnknownObject
    {
        return new UnknownObject($this->ms, $path, $type, $content);
    }
}
