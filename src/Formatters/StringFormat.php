<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

/**
 * @template T
 *
 * @implements JsonFormatter<string>
 */
class StringFormat extends MultiDecoder
{
    public static function encode(string $content): string
    {
        return $content;
    }
}
