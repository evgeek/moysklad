<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Services;

use Evgeek\Moysklad\Http\Payload;
use Generator;
use SplQueue;

class Url
{
    public const API = 'https://online.moysklad.ru/api/remap/1.2';

    public static function make(SplQueue $payloadList): string
    {
        /** @var Payload $payload */
        $payload = $payloadList->bottom();

        $url = static::API;
        foreach (static::payloadsGenerator($payloadList) as $payload) {
            $url .= "/$payload->path";
        }

        $url .= static::prepareQueryParams($payload);

        return $url;
    }

    private static function prepareQueryParams(Payload $payload): string
    {
        $params = $payload->params;
        $paramsString = http_build_query($params);

        return $paramsString === '' ? '' : "?$paramsString";
    }

    /**
     * @return Generator<Payload>
     */
    private static function payloadsGenerator(SplQueue $payloadList): Generator
    {
        $payloadList->rewind();
        while ($payloadList->current() !== null) {
            yield $payloadList->current();
            $payloadList->next();
        }
    }
}
