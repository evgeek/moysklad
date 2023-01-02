<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Handlers\Format;

use Evgeek\Moysklad\Exceptions\FormatException;
use stdClass;
use Throwable;

class ObjectFormatHandler extends AbstractFormatHandler
{
    /**
     * @throws FormatException
     */
    public static function decode(string|array|object $content): object|array
    {
        if (is_object($content)) {
            return $content;
        }

        try {
            if (!is_string($content)) {
                $content = json_encode($content, JSON_THROW_ON_ERROR);
            }
            if ($content === '') {
                return new stdClass();
            }
            $result = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $e) {
            throw new FormatException("Can't convert " . gettype($content) . " to object. " .
                "Message: {$e->getMessage()}" . PHP_EOL . " Content:" . PHP_EOL . $content);
        }

        return $result;
    }
}
