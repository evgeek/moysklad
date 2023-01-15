<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Services;

use Evgeek\Moysklad\Http\Payload;

class Url
{
    public const API = 'https://online.moysklad.ru/api/remap/1.2';

    public static function make(Payload $payload): string
    {
        return self::prepareUrl($payload->path) . static::prepareQueryParams($payload->params);
    }

    private static function prepareUrl(array $path): string
    {
        return static::API . '/' . implode('/', $path);
    }

    private static function prepareQueryParams(array $params): string
    {
        $paramsString = http_build_query($params);

        return $paramsString === '' ? '' : "?$paramsString";
    }
}
