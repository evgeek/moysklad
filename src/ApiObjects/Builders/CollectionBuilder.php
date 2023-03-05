<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Builders;

use Evgeek\Moysklad\ApiObjects\Collections\ProductCollection;

class CollectionBuilder extends AbstractBuilder
{
    public function product(mixed $content = []): ProductCollection
    {
        return new ProductCollection($this->ms, $content);
    }
}
