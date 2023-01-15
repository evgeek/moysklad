<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

use Evgeek\Moysklad\Exceptions\FormatException;
use Throwable;

/**
 * @template T
 *
 * @implements JsonFormatter<T>
 */
abstract class MultiDecoder implements JsonFormatter
{
    public static function decode(mixed $content): string
    {
        if ($content === null) {
            return '';
        }

        try {
            $decodedContent = json_encode($content, JSON_THROW_ON_ERROR);
        } catch (Throwable $e) {
            throw new FormatException("Can't convert " . gettype($decodedContent) . ' content to json string. ' .
                "Message: {$e->getMessage()}" . PHP_EOL . ' Content:' . PHP_EOL . $content);
        }

        return is_string($content) ? $content : $decodedContent;
    }
}
