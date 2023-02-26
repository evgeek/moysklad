<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Tools;

class Guid
{
    /**
     * Returns array with all guids from string
     */
    public static function extractAll(string $url): array
    {
        $pattern = '/({)?[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}(})?/';
        preg_match_all($pattern, $url, $resultArr);

        return $resultArr[0];
    }

    /**
     * Returns the first guid from the string (or null if there is no guid)
     */
    public static function extractFirst(string $url): ?string
    {
        $guids = static::extractAll($url);

        return $guids[0] ?? null;
    }

    /**
     * Returns the last guid from the string (or null if there is no guid)
     */
    public static function extractLast(string $url): ?string
    {
        $guids = static::extractAll($url);
        $last = end($guids);

        return $last ?: null;
    }
}
