<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Builders;

use Evgeek\Moysklad\ApiObjects\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\ApiObjects\Collections\AssortmentCollection;
use Evgeek\Moysklad\ApiObjects\Collections\CustomerorderCollection;
use Evgeek\Moysklad\ApiObjects\Collections\EmployeeCollection;
use Evgeek\Moysklad\ApiObjects\Collections\ProductCollection;
use Evgeek\Moysklad\ApiObjects\Collections\UnknownCollection;
use Evgeek\Moysklad\Dictionaries\Entity;

class CollectionObjectBuilder extends AbstractObjectBuilder
{
    /** @return ProductCollection */
    public function product(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Entity::PRODUCT);
    }

    /** @return EmployeeCollection */
    public function employee(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Entity::EMPLOYEE);
    }

    /** @return AssortmentCollection */
    public function assortment(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Entity::ASSORTMENT);
    }

    /** @return CustomerorderCollection */
    public function customerorder(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Entity::CUSTOMERORDER);
    }

    public function unknown(array $path, string $type): UnknownCollection
    {
        return new UnknownCollection($this->ms, $path, $type);
    }
}
