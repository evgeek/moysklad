<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Params;

use Evgeek\Moysklad\Enums\FilterSign;
use Evgeek\Moysklad\Services\QueryParams;

trait FilterTrait
{
    private FilterSign $defaultSign = FilterSign::EQ;

    /**
     * Фильтрация результатов.
     * Принимает три параметра (имя свойства, знак, значение) или два (имя свойства и значение, знак по умолчанию - '=').
     * Несколько фильтров можно применить, вызвав метод несколько раз, или при помощи массива массивов.
     *
     * <code>
     * $products = $ms->query()->entity()->product()
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
        $this->params = QueryParams::setFilter($this->params, $key, $sign, $value);

        return $this;
    }
}
