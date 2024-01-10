<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Services;

use Evgeek\Moysklad\Http\Payload;
use Evgeek\Moysklad\Tools\Guid;
use InvalidArgumentException;

final class Url
{
    public const API = 'https://api.moysklad.ru/api/remap/1.2';

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

    public static function makeFromPathAndParams(array $path, array $params = []): string
    {
        return self::prepareUrl($path) . self::prepareQueryParams($params);
    }

    public static function parsePathAndParams(string $url): array
    {
        if (!str_starts_with($url, self::API)) {
            throw new InvalidArgumentException("Url '$url' does not belongs to Moysklad JSON API v1.2");
        }

        $pathString = substr($url, strlen(self::API) + 1);

        $params = [];
        $paramsString = parse_url($url)['query'] ?? null;
        if ($paramsString) {
            $params = self::parseStr($paramsString);
            $pathString = str_replace("?$paramsString", '', $pathString);
        }

        $path = explode('/', $pathString);
        if ($path[array_key_last($path)] === '') {
            array_pop($path);
        }

        return [$path, $params];
    }

    public static function getId(string $url)
    {
        [$path] = self::parsePathAndParams($url);
        $lastSegment = array_pop($path);

        return Guid::check($lastSegment) ? $lastSegment : null;
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

    /** @return array<int|string, string> */
    private static function parseStr(string $query): array
    {
        $data = preg_replace_callback(
            '/(?:^|(?<=&))[^=[]+/',
            static fn ($match) => bin2hex(urldecode($match[0])),
            $query
        );

        parse_str($data, $values);

        return array_combine(array_map('hex2bin', array_keys($values)), $values);
    }
}
