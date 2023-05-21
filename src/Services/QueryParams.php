<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Services;

use Evgeek\Moysklad\Enums\FilterSign;
use Evgeek\Moysklad\Enums\OrderDirection;
use Evgeek\Moysklad\Enums\QueryParam;
use InvalidArgumentException;

final class QueryParams
{
    public static function setSearch(array $params, string $text): array
    {
        return self::set($params, QueryParam::SEARCH, $text);
    }

    public static function setOrder(array $params, array|string $field, OrderDirection|string $direction = OrderDirection::ASC): array
    {
        if (is_array($field)) {
            return self::handleArrayOfOrders($params, $field);
        }

        $directionString = is_a($direction, OrderDirection::class) ? $direction->value : $direction;
        $sort = $field . ',' . $directionString;

        return self::set($params, QueryParam::ORDER, $sort);
    }

    public static function setLimit(array $params, int $limit): array
    {
        return self::set($params, QueryParam::LIMIT, $limit);
    }

    public static function setOffset(array $params, int $offset): array
    {
        return self::set($params, QueryParam::OFFSET, $offset);
    }

    public static function setFilter(
        array $params,
        array|string $key,
        FilterSign|string|int|float|bool $sign = null,
        string|int|float|bool $value = null
    ): array {
        if (is_array($key)) {
            return self::handleArrayOfFilters($params, $key);
        }

        [$signString, $valueString] = self::prepareSignAndValueAsStrings($key, $sign, $value);
        $filter = $key . $signString . self::escapeSemicolon($valueString);

        return self::set($params, QueryParam::FILTER, $filter);
    }

    public static function setExpand(array $params, array|string $field): array
    {
        if (is_array($field)) {
            return self::handleArrayOfExpands($params, $field);
        }

        return self::set($params, QueryParam::EXPAND, $field);
    }

    public static function setParam(array $params, array|string $key, string|int|float|bool|null $value = null): array
    {
        if (is_array($key)) {
            return self::handleArrayOfParams($params, $key);
        }

        if ($value === null) {
            throw new InvalidArgumentException("Value can't be null for the key '$key'");
        }

        return self::set($params, $key, $value);
    }

    private static function handleArrayOfOrders(array $params, array $orders): array
    {
        foreach ($orders as $order) {
            if (!is_array($order)) {
                throw new InvalidArgumentException('Each order must be an array');
            }
            $params = self::setOrder($params, ...$order);
        }

        return $params;
    }

    private static function handleArrayOfFilters(array $params, array $filters): array
    {
        foreach ($filters as $filter) {
            if (!is_array($filter)) {
                throw new InvalidArgumentException('Each filter must be an array');
            }
            $params = self::setFilter($params, ...$filter);
        }

        return $params;
    }

    /**
     * @return string[]
     */
    private static function prepareSignAndValueAsStrings(
        string $key,
        FilterSign|string|int|float|bool|null $sign,
        string|int|float|bool|null $value
    ): array {
        $prefix = "For filter key '$key': ";

        if ($sign === null) {
            throw new InvalidArgumentException($prefix . 'sign missed');
        }

        if ($value === null) {
            if (is_a($sign, FilterSign::class)) {
                throw new InvalidArgumentException($prefix . 'with a sign, you must pass the value as the third parameter');
            }

            /** @var bool|float|int|string $sign */
            $value = $sign;
            $sign = FilterSign::EQ;
        } elseif (!is_a($sign, FilterSign::class) && !is_string($sign)) {
            throw new InvalidArgumentException($prefix . 'with a value, sign must be a string or ' . FilterSign::class);
        }

        if (is_a($sign, FilterSign::class)) {
            $sign = $sign->value;
        }
        $value = Url::convertMixedValueToString($value);

        return [$sign, $value];
    }

    private static function escapeSemicolon(string $value): string
    {
        return str_replace(';', '\;', $value);
    }

    private static function handleArrayOfExpands(array $params, array $expands): array
    {
        foreach ($expands as $expand) {
            if (!is_string($expand)) {
                throw new InvalidArgumentException('Each expand must be a string');
            }

            $params = self::setExpand($params, $expand);
        }

        return $params;
    }

    private static function handleArrayOfParams(array $params, array $settableParams): array
    {
        foreach ($settableParams as $param) {
            if (!is_array($param)) {
                throw new InvalidArgumentException('Each param must be an array');
            }
            $params = self::setParam($params, ...$param);
        }

        return $params;
    }

    private static function set(array $params, QueryParam|string $queryParam, string|int|float|bool $value): array
    {
        $stringQueryParam = is_string($queryParam) ? $queryParam : $queryParam->value;
        $stringValue = Url::convertMixedValueToString($value);

        $separator = QueryParam::getSeparator($stringQueryParam);
        if ($separator === '') {
            $params[$stringQueryParam] = $stringValue;

            return $params;
        }

        if (!array_key_exists($stringQueryParam, $params)) {
            $params[$stringQueryParam] = '';
        }
        $params[$stringQueryParam] .= $params[$stringQueryParam] === '' ?
            $stringValue :
            $separator . $stringValue;

        return $params;
    }
}
