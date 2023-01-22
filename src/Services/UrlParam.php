<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Services;

class UrlParam
{
    private const FILTER_DELIMITER = ';';
    private const FILTER_ESCAPED_DELIMITER = '\;';

    public static function convertMixedValueToString(string|int|float|bool $value): string
    {
        if (is_bool($value)) {
            return var_export($value, true);
        }

        return (string) $value;
    }

    public static function escapeCharactersForFilter(string $value): string
    {
        return str_replace(self::FILTER_DELIMITER, self::FILTER_ESCAPED_DELIMITER, $value);
    }
}
