<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Enums;

enum QueryParams: string
{
    case EXPAND = 'expand';
    case FILTER = 'filter';
    case ORDER  = 'order';
    case LIMIT  = 'limit';
    case OFFSET = 'offset';
    case SEARCH = 'search';

    public function separator(): string
    {
        return match ($this) {
            self::EXPAND => ',',
            self::FILTER, self::ORDER => ';',
            default => ''
        };
    }
}