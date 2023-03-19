<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects;

use Evgeek\Moysklad\ApiObjects\AutocompleteHelpers\MetaObject;

/**
 * @property string      $id
 * @property string      $name
 * @property ?MetaObject $meta
 */
class Product extends AbstractConcreteObject
{
    public const PATH = [
        'entity',
        'product',
    ];
    public const TYPE = 'product';
}
