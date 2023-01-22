<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Services;

use Evgeek\Moysklad\Exceptions\ConfigException;
use Evgeek\Moysklad\Formatters\JsonFormatter;
use Evgeek\Moysklad\Formatters\StdClassFormat;

final class Formatter
{
    /** @var class-string<JsonFormatter> DEFAULT */
    public const DEFAULT = StdClassFormat::class;

    /**
     * @param class-string<JsonFormatter> $formatter
     *
     * @throws ConfigException
     */
    public static function resolve(string $formatter): JsonFormatter
    {
        if (!is_subclass_of($formatter, JsonFormatter::class)) {
            throw new ConfigException('Formatter' . $formatter . ' must implements ' . JsonFormatter::class . ' interface');
        }

        return new $formatter();
    }

    /**
     * @throws ConfigException
     */
    public static function resolveDefault(): JsonFormatter
    {
        return self::resolve(self::DEFAULT);
    }
}
