<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

use Evgeek\Moysklad\Exceptions\FormatException;
use Throwable;

/**
 * @template T
 *
 * @implements JsonFormatter<array>
 */
class ArrayFormat extends MultiDecoder
{
    public static function encode(string $content): array
    {
        if ($content === '') {
            return [];
        }

        try {
            $encodedContent = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $e) {
            throw new FormatException('Can\'t convert content to array. ' .
                "Message: {$e->getMessage()}" . PHP_EOL . ' Content:' . PHP_EOL . $content);
        }

        return $encodedContent;
    }
}
