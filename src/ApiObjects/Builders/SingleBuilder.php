<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Builders;

use Evgeek\Moysklad\ApiObjects\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\ApiObjects\Objects\Product;

class SingleBuilder extends AbstractBuilder
{
    /**
     * @return Product
     */
    public function product(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Product::TYPE, $content);
    }
}
