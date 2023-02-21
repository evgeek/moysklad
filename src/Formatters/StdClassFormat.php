<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

use InvalidArgumentException;
use stdClass;
use Throwable;

/**
 * @template T
 *
 * @implements JsonFormatterInterface<stdClass>
 */
class StdClassFormat extends AbstractMultiDecoder
{
    /**
     * @return array<stdClass>|stdClass
     */
    public static function encode(string $content): stdClass|array
    {
        if ($content === '') {
            return new stdClass();
        }

        try {
            $encodedContent = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $e) {
            $message = "Can't convert content to object. Message: {$e->getMessage()}" . PHP_EOL . ' Content:' . PHP_EOL . $content;

            throw new InvalidArgumentException($message, $e->getCode(), $e);
        }

        return $encodedContent;
    }
}
