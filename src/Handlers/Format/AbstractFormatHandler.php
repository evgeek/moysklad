<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Handlers\Format;

use Evgeek\Moysklad\Exceptions\FormatException;
use Throwable;

abstract class AbstractFormatHandler implements FormatHandlerInterface
{
    /**
     * @throws FormatException
     */
    public static function encode(string|array|object $content): string
    {
        if (is_string($content)) {
            return $content;
        }

        try {
            $content = json_encode($content, JSON_THROW_ON_ERROR);
        } catch (Throwable $e) {
            throw new FormatException("Can't convert " . gettype($content) . ' to string. ' .
                "Message: {$e->getMessage()}" . PHP_EOL . ' Content:' . PHP_EOL . $content);
        }

        return $content;
    }
}
