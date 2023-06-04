<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Services;

use Evgeek\Moysklad\Api\Record\AbstractRecord;

final class CollectionHelper
{
    public static function extractRows(mixed $objects): mixed
    {
        if (
            is_subclass_of($objects, AbstractRecord::class)
            && isset($objects->rows)
            && is_array($objects->rows)
        ) {
            return $objects->rows;
        }

        return $objects;
    }
}
