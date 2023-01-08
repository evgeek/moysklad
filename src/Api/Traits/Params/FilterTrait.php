<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Params;

use Evgeek\Moysklad\Enums\QueryParams;
use Evgeek\Moysklad\Filter;

trait FilterTrait
{
    /**
     * Filter results
     * <code>
     * $product = $ms->query()
     *    ->entity()
     *   ->product()
     *   ->filter(
     *       (new \Evgeek\Moysklad\Filter())
     *           ->eq('archived', 'false')
     *           ->neq('name', 'orange')
     *   )
     *   ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-fil-traciq-wyborki-s-pomosch-u-parametra-filter
     */
    public function filter(Filter $filter): static
    {
        $filterString = $filter->getFiltersString();
        if ($filterString === '') {
            return $this;
        }
        if (!array_key_exists(QueryParams::FILTER->value, $this->params)) {
            $this->params[QueryParams::FILTER->value] = '';
        }
        $this->params[QueryParams::FILTER->value] .= $this->params[QueryParams::FILTER->value] === '' ?
            $filterString :
            QueryParams::FILTER->separator() . $filterString;

        return $this;
    }
}
