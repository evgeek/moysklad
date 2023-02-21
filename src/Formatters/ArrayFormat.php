<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

use InvalidArgumentException;
use Throwable;

/**
 * @template T
 *
 * @implements JsonFormatterInterface<array>
 */
class ArrayFormat extends AbstractMultiDecoder
{
    public static function encode(string $content): array
    {
        if ($content === '') {
            return [];
        }

        try {
            $encodedContent = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $e) {
            $message = "Can't convert content to array. Message: {$e->getMessage()}" . PHP_EOL . ' Content:' . PHP_EOL . $content;

            throw new InvalidArgumentException($message, $e->getCode(), $e);
        }

        return $encodedContent;
    }
}
