<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Collections\Traits;

use Evgeek\Moysklad\ApiObjects\Meta\MetaCollection;

trait SetMetaCollectionTrait
{
    protected function convertMetaToObject(mixed $meta): MetaCollection
    {
        return new MetaCollection($this->ms, $meta);
    }
}
