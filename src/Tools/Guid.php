<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Tools;

class Guid
{
    /**
     * Возвращает массив из всех guid, встречающихся в строке.
     */
    public static function extractAll(string $url): array
    {
        $pattern = '/({)?[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}(})?/';
        preg_match_all($pattern, $url, $resultArr);

        return $resultArr[0];
    }

    /**
     * Возвращает первый guid, найденный в строке, или null в случае его отсутствия.
     */
    public static function extractFirst(string $url): ?string
    {
        $guids = static::extractAll($url);

        return $guids[0] ?? null;
    }

    /**
     * Возвращает последний guid, найденный в строке, или null в случае его отсутствия.
     */
    public static function extractLast(string $url): ?string
    {
        $guids = static::extractAll($url);
        $last = end($guids);

        return $last ?: null;
    }

    /**
     * Определяет, является ли строка валидным guid.
     */
    public static function isGuid(string $guid): bool
    {
        return $guid === static::extractFirst($guid);
    }
}
