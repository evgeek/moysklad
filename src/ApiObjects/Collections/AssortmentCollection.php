<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Collections;

use Evgeek\Moysklad\ApiObjects\Objects\Product;
use Evgeek\Moysklad\ApiObjects\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Endpoint;
use Evgeek\Moysklad\Dictionaries\Entity;

/**
 * Коллекция ассортиментов
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-assortiment
 *
 * @implements AbstractConcreteCollection<Product>
 * @implements AbstractConcreteCollection<UnknownObject>
 */
class AssortmentCollection extends AbstractConcreteCollection
{
    public const PATH = [
        Endpoint::ENTITY,
        Entity::ASSORTMENT,
    ];
    public const TYPE = Entity::ASSORTMENT;
}