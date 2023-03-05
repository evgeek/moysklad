<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Services;

use Evgeek\Moysklad\Http\Payload;
use InvalidArgumentException;

final class Url
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
        return self::makeFromPathAndParams($payload->path, $payload->params);
    }

    public static function makeFromPathAndParams(array $path, array $params): string
    {
        return self::prepareUrl($path) . self::prepareQueryParams($params);
    }

    public static function parsePathAndParams(string $url): array
    {
        if (!str_starts_with($url, self::API)) {
            throw new InvalidArgumentException('Wrong url');
        }

        $pathString = substr($url, strlen(self::API) + 1);

        $params = [];
        $paramsString = parse_url($url)['query'] ?? null;
        if ($paramsString) {
            parse_str($paramsString, $params);
            $pathString = str_replace("?$paramsString", '', $pathString);
        }

        $path = explode('/', $pathString);

        return [$path, $params];
    }

    /**
     * @param string[] $path
     */
    private static function prepareUrl(array $path): string
    {
        return self::API . '/' . implode('/', $path);
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
