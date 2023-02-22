<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

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
        } catch (Throwable) {
            static::throwContentIsNotValidJsonObject($content);
        }

        if (!is_array($encodedContent)) {
            static::throwContentIsNotValidJsonObject($content);
        }

        return $encodedContent;
    }
}
