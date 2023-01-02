<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Handlers\Format;

use Evgeek\Moysklad\Exceptions\FormatException;
use Throwable;

class ArrayFormatHandler extends AbstractFormatHandler
{
    /**
     * @throws FormatException
     */
    public static function decode(string|array|object $content): array
    {
        if (is_array($content)) {
            return $content;
        }

        try {
            if (!is_string($content)) {
                $content = json_encode($content, JSON_THROW_ON_ERROR);
            }
            if ($content === '') {
                return [];
            }
            $result = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $e) {
            throw new FormatException("Can't convert " . gettype($content) . ' to array. ' .
                "Message: {$e->getMessage()}" . PHP_EOL . ' Content:' . PHP_EOL . $content);
        }

        return $result;
    }
}
