<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Services;

use Evgeek\Moysklad\ApiObjects\AbstractApiObject;

final class CollectionHelper
{
    public static function extractRows(mixed $objects): mixed
    {
        if (
            is_subclass_of($objects, AbstractApiObject::class)
            && isset($objects->rows)
            && is_array($objects->rows)
        ) {
            return $objects->rows;
        }

        return $objects;
    }
}
