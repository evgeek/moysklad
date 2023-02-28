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
    public function decode(mixed $content): string
    {
        if ($this->contentIsEmpty($content)) {
            return '';
        }

        if (is_string($content)) {
            $this->validateStringIsJsonObject($content);

            return $content;
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

    protected function validateStringIsJsonObject(string $content): void
    {
        try {
            $decodedContent = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable) {
            $this->throwContentIsNotValidJsonObject($content);
        }

        if (!is_array($decodedContent)) {
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
