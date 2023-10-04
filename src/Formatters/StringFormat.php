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
    public function encode(string $content): string
    {
        return $content;
    }
}
