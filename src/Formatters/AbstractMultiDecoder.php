<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

use InvalidArgumentException;
use Throwable;

/**
 * @template T
 *
 * @implements JsonFormatterInterface<T>
 */
abstract class AbstractMultiDecoder implements JsonFormatterInterface
{
    public static function decode(mixed $content): string
    {
        if (static::contentIsEmpty($content)) {
            return '';
        }

        if (is_string($content)) {
            static::validateStringIsJsonObject($content);

            return $content;
        }

        try {
            $decodedContent = json_encode($content, JSON_THROW_ON_ERROR);
        } catch (Throwable) {
            $type = is_object($content) ? $content::class : gettype($content);

            throw new InvalidArgumentException("Can't convert content of '$type' type to json string.");
        }

        static::validateStringIsJsonObject($decodedContent);

        return $decodedContent;
    }

    protected static function validateStringIsJsonObject(string $content): void
    {
        try {
            $decodedContent = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable) {
            static::throwContentIsNotValidJsonObject($content);
        }

        if (!is_array($decodedContent)) {
            static::throwContentIsNotValidJsonObject($content);
        }
    }

    protected static function throwContentIsNotValidJsonObject(string $content): never
    {
        throw new InvalidArgumentException('Passed content is not valid json. Content:' . $content . PHP_EOL);
    }

    protected static function contentIsEmpty(mixed $content): bool
    {
        return !$content || (is_object($content) && (array) $content === []);
    }
}
