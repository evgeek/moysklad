<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Services;

use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\ObjectInterface;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Tools\Guid;
use InvalidArgumentException;

final class NestedRecordHelper
{
    public static function getParentPath(MoySklad $ms, ObjectInterface|array|string $parent): array
    {
        if (is_array($parent)) {
            return $parent;
        }

        if (is_string($parent)) {
            if (is_a($parent, AbstractConcreteObject::class, true)) {
                $parentClass = $parent;
            } else {
                $parentClass = RecordMappingHelper::getMapping($ms)->getObject($parent);
                if (!is_a($parentClass, AbstractConcreteObject::class, true)) {
                    throw new InvalidArgumentException('String parent must be type of ' .
                        AbstractConcreteObject::class);
                }
            }

            $parent = new $parentClass($ms);
        }

        if (($parent->meta ?? null) === null || ($parent->meta->href ?? null) === null) {
            throw new InvalidArgumentException('Parent object missing meta->href property');
        }

        [$path] = Url::parsePathAndParams($parent->meta->href);

        return $path;
    }

    public static function clearParentPath(array $parentPath, array $nestedPath): array
    {
        if (Guid::check($parentPath[array_key_last($parentPath)])) {
            unset($parentPath[array_key_last($parentPath)]);
        }

        foreach (array_reverse($nestedPath) as $segment) {
            if ($parentPath[array_key_last($parentPath)] === $segment) {
                unset($parentPath[array_key_last($parentPath)]);
            }
        }

        return $parentPath;
    }
}
