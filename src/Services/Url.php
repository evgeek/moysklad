<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Services;

use Evgeek\Moysklad\Http\Payload;

class Url
{
    public const API = 'https://online.moysklad.ru/api/remap/1.2';

    public static function convertMixedValueToString(string|int|float|bool $value): string
    {
        if (is_bool($value)) {
            return var_export($value, true);
        }

        return (string) $value;
    }

    public static function make(Payload $payload): string
    {
        return self::prepareUrl($payload->path) . static::prepareQueryParams($payload->params);
    }

    /**
     * @param string[] $path
     */
    private static function prepareUrl(array $path): string
    {
        return static::API . '/' . implode('/', $path);
    }

    /**
     * @param string[] $params
     */
    private static function prepareQueryParams(array $params): string
    {
        $paramsString = http_build_query($params);

        return $paramsString === '' ? '' : "?$paramsString";
    }
}
