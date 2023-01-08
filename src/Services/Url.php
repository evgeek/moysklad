<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Services;

use Evgeek\Moysklad\Http\Payload;

class Url
{
    public static function make(Payload $payload): string
    {
        return $payload->url . static::prepareQueryParams($payload);
    }

    private static function prepareQueryParams(Payload $payload): string
    {
        $params = $payload->params;
        $paramsString = http_build_query($params);

        return $paramsString === '' ? '' : "?$paramsString";
    }
}
