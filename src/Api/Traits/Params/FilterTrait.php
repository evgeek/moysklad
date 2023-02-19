<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Params;

use Evgeek\Moysklad\Enums\FilterSign;
use Evgeek\Moysklad\Enums\QueryParams;
use Evgeek\Moysklad\Exceptions\InputException;
use Evgeek\Moysklad\Services\UrlParam;

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
     *
     * @throws InputException
     */
    public function filter(
        array|string $key,
        FilterSign|string|int|float|bool $sign = null,
        string|int|float|bool $value = null
    ): static {
        if (is_array($key)) {
            return $this->handleArrayOfFilters($key);
        }

        [$signPrepared, $valuePrepared] = $this->prepareSignAndValueAsStrings($key, $sign, $value);
        $this->addFilterToParams($key, $signPrepared, $valuePrepared);

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
     *
     * @throws InputException
     */
    public function filters(array $filters): static
    {
        return $this->handleArrayOfFilters($filters);
    }

    /**
     * @throws InputException
     */
    private function handleArrayOfFilters(array $filters): static
    {
        foreach ($filters as $filter) {
            if (!is_array($filter)) {
                throw new InputException('Each filter must be an array');
            }
            $this->filter(...$filter);
        }

        return $this;
    }

    /**
     * @return string[]
     *
     * @throws InputException
     */
    private function prepareSignAndValueAsStrings(
        string $key,
        FilterSign|string|int|float|bool|null $sign,
        string|int|float|bool|null $value
    ): array {
        $prefix = "For filter key '$key': ";

        if ($sign === null) {
            throw new InputException($prefix . 'sign missed');
        }

        if ($value === null) {
            if (is_a($sign, FilterSign::class)) {
                throw new InputException($prefix . 'with a sign, you must pass the value as the third parameter');
            }

            /** @var bool|float|int|string $sign */
            $value = $sign;
            $sign = $this->defaultSign;
        } elseif (!is_a($sign, FilterSign::class) && !is_string($sign)) {
            throw new InputException($prefix . 'with a value, sign must be a string or ' . FilterSign::class);
        }

        if (is_a($sign, FilterSign::class)) {
            $sign = $sign->value;
        }
        $value = UrlParam::convertMixedValueToString($value);

        return [$sign, $value];
    }

    private function addFilterToParams(string $key, string $sign, string $value): void
    {
        if (!array_key_exists(QueryParams::FILTER->value, $this->params)) {
            $this->params[QueryParams::FILTER->value] = '';
        }

        $filterString = UrlParam::escapeCharactersForFilter($key) . $sign . UrlParam::escapeCharactersForFilter($value);

        $this->params[QueryParams::FILTER->value] .= $this->params[QueryParams::FILTER->value] === '' ?
            $filterString :
            QueryParams::FILTER->separator() . $filterString;
    }
}
