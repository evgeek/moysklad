<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

/**
 * @template T
 */
interface JsonFormatterInterface
{
    /**
     * Encode json response string to T format
     *
     * @return T
     */
    public static function encode(string $content);

    /**
     * Decode content to json string format
     */
    public static function decode(mixed $content): string;
}
