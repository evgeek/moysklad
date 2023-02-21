<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Enums;

use Throwable;

enum QueryParam: string
{
    case EXPAND = 'expand';
    case FILTER = 'filter';
    case ORDER  = 'order';
    case LIMIT  = 'limit';
    case OFFSET = 'offset';
    case SEARCH = 'search';

    public function separator(): string
    {
        return self::matchSeparator($this);
    }

    public static function getSeparator(self|string $queryParam): string
    {
        if (is_string($queryParam)) {
            try {
                $enumParam = self::from($queryParam);
                $separator = $enumParam->separator();
            } catch (Throwable) {
                $separator = '';
            }

            return $separator;
        }

        return self::matchSeparator($queryParam);
    }

    private static function matchSeparator(self $queryParam): string
    {
        return match ($queryParam) {
            self::EXPAND => ',',
            self::FILTER, self::ORDER => ';',
            default => ''
        };
    }
}
