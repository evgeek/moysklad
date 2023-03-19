<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Builders;

use Evgeek\Moysklad\ApiObjects\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\ApiObjects\Collections\ProductCollection;

class CollectionBuilder extends AbstractBuilder
{
    /**
     * @return ProductCollection
     */
    public function product(mixed $content = []): AbstractConcreteCollection
    {
        return $this->resolveCollection(ProductCollection::TYPE, $content);
    }
}
