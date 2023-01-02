<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Enums;

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
}
