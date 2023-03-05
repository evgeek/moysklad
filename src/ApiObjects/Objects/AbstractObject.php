<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects;

use Evgeek\Moysklad\ApiObjects\AbstractApiObject;
use Evgeek\Moysklad\ApiObjects\Meta\MetaObject;
use Evgeek\Moysklad\MoySklad;

abstract class AbstractObject extends AbstractApiObject
{
    protected function convertMetaToObject(mixed $value): self
    {
        return new MetaObject($this->ms, $value);
    }
}
