<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Services;

use Evgeek\Moysklad\Api\Record\AbstractConcreteRecord;
use Evgeek\Moysklad\Api\Record\AbstractNestedRecord;
use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\AbstractNestedObject;
use Evgeek\Moysklad\Api\Record\Objects\ObjectInterface;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\Formatters\RecordFormat;
use Evgeek\Moysklad\Formatters\RecordMapping;
use Evgeek\Moysklad\MoySklad;
use InvalidArgumentException;

final class RecordMappingHelper
{
    public static function resolveObject(MoySklad $ms, string $type, mixed $content = []): AbstractConcreteObject
    {
        $class = self::getMapping($ms)->getObject($type);

        if (!is_a($class, AbstractConcreteObject::class, true)) {
            throw new InvalidArgumentException("Object type '$type' has no mapped class");
        }

        return new $class($ms, $content);
    }
    public static function resolveNestedObject(
        MoySklad $ms,
        ObjectInterface|array|string $parent,
        string $type,
        mixed $content = []
    ): AbstractNestedObject
    {
        $class = self::getMapping($ms)->getObject($type);

        if (is_a($class, UnknownObject::class, true)) {
            throw new InvalidArgumentException("Nested object type '$type' has no mapped class");
        }

        if (!is_a($class, AbstractNestedObject::class, true)) {
            throw new InvalidArgumentException("Nested object type '$type' has wrong mapped class");
        }

        return new $class($ms, $parent, $content);
    }

    public static function resolveCollection(MoySklad $ms, string $type): AbstractConcreteCollection
    {
        $class = self::getMapping($ms)->getCollection($type);

        if (!is_a($class, AbstractConcreteCollection::class, true)) {
            throw new InvalidArgumentException("Collection type '$type' has no mapped class");
        }

        return new $class($ms);
    }

    public static function resolveNestedCollection(MoySklad $ms, ObjectInterface|array|string $parent, string $type): AbstractNestedCollection
    {
        $class = self::getMapping($ms)->getCollection($type);

        if (is_a($class, UnknownCollection::class, true)) {
            throw new InvalidArgumentException("Nested collection type '$type' has no mapped class");
        }

        if (!is_a($class, AbstractNestedCollection::class, true)) {
            throw new InvalidArgumentException("Nested collection type '$type' has wrong mapped class");
        }

        return new $class($ms, $parent);
    }

    public static function getMapping(MoySklad $ms): RecordMapping
    {
        $formatter = $ms->getFormatter();

        return is_a($formatter, RecordFormat::class) ?
            $formatter->getMapping() :
            new RecordMapping();
    }
}
