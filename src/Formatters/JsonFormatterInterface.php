<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

use Evgeek\Moysklad\Exceptions\FormatException;

/**
 * @template T
 */
interface JsonFormatterInterface
{
    /**
     * Encode json response string to T format
     *
     * @return T
     *
     * @throws FormatException
     */
    public static function encode(string $content);

    /**
     * Decode T object to json string format
     *
     * @throws FormatException
     */
    public static function decode(mixed $content): string;
}
