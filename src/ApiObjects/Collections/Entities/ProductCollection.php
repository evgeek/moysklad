<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Collections\Entities;

use Evgeek\Moysklad\ApiObjects\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\ApiObjects\Objects\Entities\Product;
use Evgeek\Moysklad\Dictionaries\Endpoint;
use Evgeek\Moysklad\Dictionaries\Entity;

/**
 * Коллекция товаров
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-towar
 *
 * @implements AbstractConcreteCollection<Product>
 */
class ProductCollection extends AbstractConcreteCollection
{
    public const PATH = [
        Endpoint::ENTITY,
        Entity::PRODUCT,
    ];
    public const TYPE = Entity::PRODUCT;
}
