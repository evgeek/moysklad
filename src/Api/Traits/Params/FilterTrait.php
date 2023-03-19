<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Params;

use Evgeek\Moysklad\Enums\FilterSign;
use Evgeek\Moysklad\Services\QueryParams;

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
        $this->params = QueryParams::setFilter($this->params, $key, $sign, $value);

        return $this;
    }
}
