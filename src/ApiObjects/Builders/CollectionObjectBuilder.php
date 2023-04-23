<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Builders;

use Evgeek\Moysklad\ApiObjects\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\ApiObjects\Collections\EmployeeCollection;
use Evgeek\Moysklad\ApiObjects\Collections\ProductCollection;
use Evgeek\Moysklad\ApiObjects\Collections\UnknownCollection;

class CollectionObjectBuilder extends AbstractObjectBuilder
{
    /** @return ProductCollection */
    public function product(): AbstractConcreteCollection
    {
        return $this->resolveCollection(ProductCollection::TYPE);
    }

    /** @return EmployeeCollection */
    public function employee(): AbstractConcreteCollection
    {
        return $this->resolveCollection(EmployeeCollection::TYPE);
    }

    public function unknown(array $path, string $type): UnknownCollection
    {
        return new UnknownCollection($this->ms, $path, $type);
    }
}
