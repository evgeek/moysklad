<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Builders;

use Evgeek\Moysklad\ApiObjects\Objects\Product;

class Entity extends AbstractObjectBuilder
{
    public function product(mixed $content = []): Product
    {
        return new Product($content, $this->formatter);
    }
}
