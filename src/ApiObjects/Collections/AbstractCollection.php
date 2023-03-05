<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Collections;

use Evgeek\Moysklad\ApiObjects\AbstractApiObject;
use Evgeek\Moysklad\ApiObjects\Meta\MetaCollection;

abstract class AbstractCollection extends AbstractApiObject
{
    protected function convertMetaToObject(mixed $value): MetaCollection
    {
        return new MetaCollection($value);
    }
}
