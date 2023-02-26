<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Params;

use Evgeek\Moysklad\Enums\FilterSign;
use Evgeek\Moysklad\Enums\QueryParam;
use Evgeek\Moysklad\Services\Url;
use InvalidArgumentException;

trait FilterTrait
{
    private FilterSign $defaultSign = FilterSign::EQ;

    /**
     * Filter results. You can only pass 2 first parameters for key and value to use '=' as a default sign.
     * Multiple filters can be passed as an array of arrays with filter params.
     * <code>
     * $product = $ms->query()->entity()->product()
     *  ->filter('archived', false)
     *  ->filter('name', '=~', 'apple')
     *  ->filter([
     *      ['minimumBalance', '=', '0'],
     *      ['code', FilterSign::NEQ, 123],
     *  ])
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-fil-traciq-wyborki-s-pomosch-u-parametra-filter
     */
    public function filter(
        array|string $key,
        FilterSign|string|int|float|bool $sign = null,
        string|int|float|bool $value = null
    ): static {
        if (is_array($key)) {
            return $this->handleArrayOfFilters($key);
        }

        [$signString, $valueString] = $this->prepareSignAndValueAsStrings($key, $sign, $value);
        $filter = $key . $signString . $this->escapeSemicolon($valueString);

        $this->setQueryParam(QueryParam::FILTER, $filter);

        return $this;
    }

    /**
     * [DEPRECATED]: Use filter() instead.
     * Filter results with multiple filters. $filters must contain arrays with 3 elements (key, sign and value) or
     *  only 2 (key and value, '=' will be used as default sign).
     * <code>
     * $product = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->filters([
     *      ['archived', false],
     *      ['name', '=', 'tangerine'],
     *      ['code', FilterSign::NEQ, 123],
     *  ])
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-fil-traciq-wyborki-s-pomosch-u-parametra-filter
     * @deprecated
     */
    public function filters(array $filters): static
    {
        return $this->handleArrayOfFilters($filters);
    }

    private function handleArrayOfFilters(array $filters): static
    {
        foreach ($filters as $filter) {
            if (!is_array($filter)) {
                throw new InvalidArgumentException('Each filter must be an array');
            }
            $this->filter(...$filter);
        }

        return $this;
    }

    /**
     * @return string[]
     */
    private function prepareSignAndValueAsStrings(
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
            $sign = $this->defaultSign;
        } elseif (!is_a($sign, FilterSign::class) && !is_string($sign)) {
            throw new InvalidArgumentException($prefix . 'with a value, sign must be a string or ' . FilterSign::class);
        }

        if (is_a($sign, FilterSign::class)) {
            $sign = $sign->value;
        }
        $value = Url::convertMixedValueToString($value);

        return [$sign, $value];
    }

    private function escapeSemicolon(string $value): string
    {
        return str_replace(';', '\;', $value);
    }
}
