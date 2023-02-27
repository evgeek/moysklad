<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

use Evgeek\Moysklad\ApiObjects\Objects\AbstractObject;
use Evgeek\Moysklad\ApiObjects\Objects\Entity\Product;
use InvalidArgumentException;
use stdClass;
use Throwable;

/**
 * @template T
 *
 * @implements JsonFormatterInterface<stdClass>
 */
class ApiObjectFormatter extends AbstractMultiDecoder
{
    private static ?ApiObjectMapping $mapping = null;

    /**
     * @return AbstractObject|stdClass|array<stdClass>|array<AbstractObject>
     */
    public static function encode(string $content): AbstractObject|stdClass|array
    {
        static::initMapping();

        if ($content === '') {
            return new stdClass();
        }

        try {
            $encodedContent = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable) {
            static::throwContentIsNotValidJsonObject($content);
        }

        if (!is_a($encodedContent, stdClass::class) && !is_array($encodedContent)) {
            static::throwContentIsNotValidJsonObject($content);
        }

        return static::convertApiObjects($encodedContent);
    }

    public static function decode(mixed $content): string
    {
        static::initMapping();

        return parent::decode($content);
    }

    public static function setMapping(ApiObjectMapping $mapping): void
    {
        static::$mapping = $mapping;
    }

    public static function getMapping(): ApiObjectMapping
    {
        static::initMapping();

        return static::$mapping;
    }

    protected static function initMapping(): void
    {
        static::$mapping = static::$mapping ?: new ApiObjectMapping();
    }

    protected static function convertApiObjects(array $content, string $path = '')
    {
        foreach ($content as $key => $value) {
            if (static::checkValueIsApiEntity($value)) {
                $content[$key] = static::convertApiObjects($value, "$path.$key");
            }
        }

        if ($type = static::getTypeFromApiEntity($content, $path)) {
            $class = static::$mapping->get($type);

            if ($class) {
                $content = new $class($content);
            }
        }

        return $content;
    }

    protected static function checkValueIsApiEntity(mixed $value): bool
    {
        return is_array($value) && array_key_exists('meta', $value) && !array_key_exists('rows', $value);
    }

    protected static function getTypeFromApiEntity(mixed $value, string $path): ?string
    {
        if (!static::checkValueIsApiEntity($value)) {
            return null;
        }

        return $value['meta']['type'] ?? null;
    }
}
