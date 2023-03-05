<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Enums;

use InvalidArgumentException;

enum HttpMethod: string
{
    case GET        = 'GET';
    case POST       = 'POST';
    case PUT        = 'PUT';
    case DELETE     = 'DELETE';
    case HEAD       = 'HEAD';
    case CONNECT    = 'CONNECT';
    case OPTIONS    = 'OPTIONS';
    case TRACE      = 'TRACE';
    case PATCH      = 'PATCH';

    public static function makeFrom(HttpMethod|string $method): HttpMethod
    {
        if (!is_string($method)) {
            return $method;
        }

        $method = strtoupper($method);
        $enumMethod = self::tryFrom($method);
        if ($enumMethod === null) {
            throw new InvalidArgumentException("'$method' is not valid HTTP method. Check " . __CLASS__);
        }

        return $enumMethod;
    }
}
