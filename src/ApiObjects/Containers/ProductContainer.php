<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Containers;

use Evgeek\Moysklad\ApiObjects\Meta\MetaContainer;
use Evgeek\Moysklad\ApiObjects\Objects\Product;
use stdClass;

/**
 * @property stdClass      $context
 * @property MetaContainer $meta
 * @property Product[]     $rows
 */
class ProductContainer extends AbstractContainer
{
}
