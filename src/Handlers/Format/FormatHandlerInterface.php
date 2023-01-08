<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Handlers\Format;

use Evgeek\Moysklad\Exceptions\FormatException;
use stdClass;

interface FormatHandlerInterface
{
    /**
     * @throws FormatException
     */
    public static function decode(stdClass|array|string $content): stdClass|array|string;

    /**
     * @throws FormatException
     */
    public static function encode(stdClass|array|string $content): string;
}
