<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Product;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Товаров
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-towar
 *
 * @implements AbstractConcreteCollection<Product>
 */
class ProductCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::PRODUCT,
    ];
    public const TYPE = Type::PRODUCT;
}
