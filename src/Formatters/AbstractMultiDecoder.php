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
        if ($content === null) {
            return '';
        }

        try {
            $decodedContent = json_encode($content, JSON_THROW_ON_ERROR);
        } catch (Throwable $e) {
            $message = "Can't convert " . gettype($content) . ' content to json string. ' .
                "Message: {$e->getMessage()}" . PHP_EOL . ' Content:' . PHP_EOL . $content;

            throw new InvalidArgumentException($message, $e->getCode(), $e);
        }

        return is_string($content) ? $content : $decodedContent;
    }
}
