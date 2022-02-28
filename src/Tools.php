<?php

declare(strict_types=1);

namespace Evgeek\Moysklad;

class Tools
{
    /**
     * Returns array with all guids from string
     */
    public static function extractGuid(string $url)
    {
        $pattern = '/({)?[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}(})?/';
        preg_match_all($pattern, $url, $resultArr);

        return $resultArr[0];
    }
}