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
    public function product(mixed $content = []): AbstractConcreteCollection
    {
        return $this->resolveCollection(ProductCollection::TYPE, $content);
    }

    /** @return EmployeeCollection */
    public function employee(mixed $content = []): AbstractConcreteCollection
    {
        return $this->resolveCollection(EmployeeCollection::TYPE, $content);
    }

    public function unknown(array $path, string $type, mixed $content = []): UnknownCollection
    {
        return new UnknownCollection($this->ms, $path, $type, $content);
    }
}
