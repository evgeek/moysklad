<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects;

use Evgeek\Moysklad\ApiObjects\AutocompleteHelpers\MetaObject;
use Evgeek\Moysklad\Dictionaries\Endpoint;
use Evgeek\Moysklad\Dictionaries\Entity;

/**
 * @property string      $id
 * @property string      $name
 * @property ?MetaObject $meta
 */
class Product extends AbstractConcreteObject
{
    public const PATH = [
        Endpoint::ENTITY,
        Entity::PRODUCT,
    ];
    public const TYPE = Entity::PRODUCT;
}
