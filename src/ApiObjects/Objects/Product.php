<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects;

use Evgeek\Moysklad\ApiObjects\Meta\MetaObject;

/**
 * @property string      $name
 * @property ?MetaObject $meta
 */
class Product extends AbstractConcreteObject
{
    protected const PATH = [
        'entity',
        'product',
    ];
    protected const TYPE = 'product';
}
