<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Containers;

use Evgeek\Moysklad\ApiObjects\AbstractApiObject;
use Evgeek\Moysklad\ApiObjects\Meta\MetaContainer;

abstract class AbstractContainer extends AbstractApiObject
{
    protected function createMeta(mixed $value): MetaContainer
    {
        return new MetaContainer($value);
    }
}
