<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Params;

use Evgeek\Moysklad\Services\QueryParams;

trait ExpandTrait
{
    /**
     * Expand nested entity. Works only with limit <= 100 (API restriction)
     * <code>
     * $product = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->limit(100)
     *  ->expand('owner')
     *  ->expand('minPrice.currency')
     *  ->expand(['group', 'images']);
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-zamena-ssylok-ob-ektami-s-pomosch-u-expand
     */
    public function expand(array|string $field): static
    {
        $this->params = QueryParams::setExpand($this->params, $field);

        return $this;
    }
}
