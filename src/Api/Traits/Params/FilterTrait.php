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
     * Filter results. You can only pass 2 first parameters for key and value to use '=' as a default sign
     * <code>
     * $product = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->filter('archived', false)
     *  ->filter('name', '=', 'tangerine')
     *  ->filter('code', FilterSign::NEQ, 123)
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-fil-traciq-wyborki-s-pomosch-u-parametra-filter
     *
     * @throws InputException
     */
    public function filter(string $key, FilterSign|string|int|float|bool $sign, string|int|float|bool $value = null): static
    {
        [$sign, $value] = $this->handleDefaultSignAndEmptyValue($key, $sign, $value);

        $value = UrlParam::convertMixedValueToString($value);
        if (is_a($sign, FilterSign::class)) {
            $sign = $sign->value;
        }

        if (!array_key_exists(QueryParams::FILTER->value, $this->params)) {
            $this->params[QueryParams::FILTER->value] = '';
        }

        $filterString = UrlParam::escapeCharactersForFilter($key) . $sign . UrlParam::escapeCharactersForFilter($value);

        $this->params[QueryParams::FILTER->value] .= $this->params[QueryParams::FILTER->value] === '' ?
            $filterString :
            QueryParams::FILTER->separator() . $filterString;

        return $this;
    }

    /**
     * Filter results with multiple filters. $filters must contain arrays with 3 elements (key, sign and value) or
     *  only 2 (key and value, '=' will be used as default sign)
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
     *
     * @throws InputException
     */
    public function filters(array $filters): static
    {
        foreach ($filters as $filter) {
            if (!is_array($filter)) {
                throw new InputException('Each filter must be an array');
            }
            if (count($filter) < 2) {
                throw new InputException('Each filter must contain at least 2 elements (key, (optional) sign and value)');
            }

            $filter = array_values($filter);
            $this->filter($filter[0], $filter[1], $filter[2] ?? null);
        }

        return $this;
    }

    /**
     * @throws InputException
     */
    private function handleDefaultSignAndEmptyValue(string $key, FilterSign|string|int|float|bool $sign, string|int|float|bool|null $value): array
    {
        if ($value === null) {
            if (is_a($sign, FilterSign::class)) {
                throw new InputException("For filter key '$key': with a sign, you must pass the value as the third parameter");
            }

            /** @var bool|float|int|string $sign */
            $value = $sign;
            $sign = $this->defaultSign;
        } elseif (!is_a($sign, FilterSign::class) && !is_string($sign)) {
            throw new InputException("For filter key '$key': with a value, sign must be a string or " . FilterSign::class);
        }

        return [$sign, $value];
    }
}
