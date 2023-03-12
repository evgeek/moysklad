<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects\Traits;

use Evgeek\Moysklad\ApiObjects\Meta\MetaObject;

trait SetMetaObjectTrait
{
    protected function convertMetaToObject(mixed $meta): MetaObject
    {
        return new MetaObject($this->ms, $meta);
    }
}
