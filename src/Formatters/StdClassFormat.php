<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

use Evgeek\Moysklad\Exceptions\FormatException;
use stdClass;
use Throwable;

/**
 * @template T
 *
 * @implements JsonFormatter<stdClass>
 */
class StdClassFormat extends MultiDecoder
{
    public static function encode(string $content): stdClass
    {
        if ($content === '') {
            return new stdClass();
        }

        try {
            $encodedContent = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $e) {
            throw new FormatException("Can't convert content to stdClass. " .
                "Message: {$e->getMessage()}" . PHP_EOL . ' Content:' . PHP_EOL . $content);
        }

        return $encodedContent;
    }
}
