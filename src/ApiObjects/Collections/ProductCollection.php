<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Collections;

use Evgeek\Moysklad\ApiObjects\AutocompleteHelpers\MetaCollection;
use Evgeek\Moysklad\ApiObjects\Objects\Product;
use stdClass;

/**
 * @property stdClass       $context
 * @property MetaCollection $meta
 * @property Product[]      $rows
 */
class ProductCollection extends AbstractConcreteCollection
{
    public const PATH = [
        'entity',
        'product',
    ];
    public const TYPE = 'product';
}
