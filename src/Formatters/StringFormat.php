<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

/**
 * @template T
 *
 * @implements JsonFormatterInterface<string>
 */
class StringFormat extends AbstractMultiDecoder
{
    public static function encode(string $content): string
    {
        if ($content === '') {
            return '';
        }

        static::validateStringIsJsonObject($content);

        return $content;
    }
}
