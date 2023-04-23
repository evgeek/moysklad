<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Services;

use Evgeek\Moysklad\ApiObjects\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\ApiObjects\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Formatters\ApiObjectFormatter;
use Evgeek\Moysklad\Formatters\ApiObjectMapping;
use Evgeek\Moysklad\MoySklad;
use InvalidArgumentException;

final class ApiObjectMappingHelper
{
    public static function resolveObject(MoySklad $ms, string $type, mixed $content): AbstractConcreteObject
    {
        $class = self::getMapping($ms)->getObject($type);

        if (!is_a($class, AbstractConcreteObject::class, true)) {
            throw new InvalidArgumentException("Object type '$type' has no mapped class");
        }

        return new $class($ms, $content);
    }

    public static function resolveCollection(MoySklad $ms, string $type): AbstractConcreteCollection
    {
        $class = self::getMapping($ms)->getCollection($type);

        if (!is_a($class, AbstractConcreteCollection::class, true)) {
            throw new InvalidArgumentException("Collection type '$type' has no mapped class");
        }

        return new $class($ms);
    }

    private static function getMapping(MoySklad $ms): ApiObjectMapping
    {
        $formatter = $ms->getApiClient()->getFormatter();

        return is_a($formatter, ApiObjectFormatter::class) ?
            $formatter->getMapping() :
            new ApiObjectMapping();
    }
}
