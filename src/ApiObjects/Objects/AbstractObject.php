<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects;

use Evgeek\Moysklad\ApiObjects\AbstractApiObject;
use Evgeek\Moysklad\ApiObjects\Meta\MetaObject;

abstract class AbstractObject extends AbstractApiObject
{
    protected function createMeta(mixed $value): self
    {
        return new MetaObject($value);
    }
}
