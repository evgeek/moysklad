<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Handlers\Format;

use Evgeek\Moysklad\Exceptions\FormatException;

interface FormatHandlerInterface
{
    /**
     * @throws FormatException
     */
    public static function decode(string|array|object $content): string|array|object;

    /**
     * @throws FormatException
     */
    public static function encode(string|array|object $content): string;
}