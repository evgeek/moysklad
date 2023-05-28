<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

use Evgeek\Moysklad\ApiObjects\AbstractApiObject;
use InvalidArgumentException;
use stdClass;
use Throwable;

/**
 * @template T
 *
 * @implements JsonFormatterInterface<T>
 */
abstract class AbstractMultiDecoder implements JsonFormatterInterface
{
    public function decode(mixed $content): string
    {
        if ($this->contentIsEmpty($content)) {
            return '';
        }

        if (is_string($content)) {
            $this->validateStringIsJsonObject($content);

            return $content;
        }

        if (is_array($content) || is_a($content, stdClass::class)) {
            $content = static::toArray($content);
        }

        try {
            $decodedContent = json_encode($content, JSON_THROW_ON_ERROR);
        } catch (Throwable) {
            $type = is_object($content) ? $content::class : gettype($content);

            throw new InvalidArgumentException("Can't convert content of '$type' type to json string.");
        }

        $this->validateStringIsJsonObject($decodedContent);

        return $decodedContent;
    }

    public static function toArray(array|stdClass|AbstractApiObject $content): array
    {
        if (is_a($content, AbstractApiObject::class)) {
            return $content->toArray();
        }

        $array = [];
        foreach ($content as $key => $value) {
            $array[$key] = is_array($value) || is_a($value, stdClass::class) ?
                self::toArray($value) :
                $value;
        }

        return $array;
    }

    public static function checkStringIsValidJson(string $content): bool
    {
        try {
            $decodedContent = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable) {
            return false;
        }

        if (!is_array($decodedContent)) {
            return false;
        }

        return true;
    }

    protected function validateStringIsJsonObject(string $content): void
    {
        if (!self::checkStringIsValidJson($content)) {
            $this->throwContentIsNotValidJsonObject($content);
        }
    }

    protected function throwContentIsNotValidJsonObject(string $content): never
    {
        throw new InvalidArgumentException('Passed content is not valid json. Content:' . $content . PHP_EOL);
    }

    protected function contentIsEmpty(mixed $content): bool
    {
        return !$content || (is_object($content) && (array) $content === []);
    }
}
