<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Services;

use Evgeek\Moysklad\Formatters\JsonFormatterInterface;
use Evgeek\Moysklad\Formatters\StdClassFormat;
use InvalidArgumentException;

final class Formatter
{
    /** @var class-string<JsonFormatterInterface> DEFAULT */
    public const DEFAULT = StdClassFormat::class;

    /**
     * @param class-string<JsonFormatterInterface> $formatter
     */
    public static function resolve(string $formatter): JsonFormatterInterface
    {
        if (!is_subclass_of($formatter, JsonFormatterInterface::class)) {
            throw new InvalidArgumentException('Formatter' . $formatter . ' must implements ' .
                JsonFormatterInterface::class . ' interface');
        }

        return new $formatter();
    }

    public static function resolveDefault(): JsonFormatterInterface
    {
        return self::resolve(self::DEFAULT);
    }
}
