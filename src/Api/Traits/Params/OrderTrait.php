<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Params;

use Evgeek\Moysklad\Enums\OrderDirection;
use Evgeek\Moysklad\Enums\QueryParam;

trait OrderTrait
{
    /**
     * Sorts result by field
     * <code>
     * $product = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->order('updated', 'desc')
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-sortirowka-ob-ektow
     */
    public function order(string $field, OrderDirection|string $direction = 'asc'): static
    {
        if (is_a($direction, OrderDirection::class)) {
            $direction = $direction->value;
        }

        $this->initQueryParam(QueryParam::ORDER);

        $sort = $field . ',' . $direction;
        $this->params[QueryParam::ORDER->value] .= $this->params[QueryParam::ORDER->value] === '' ?
            $sort :
            QueryParam::ORDER->separator() . $sort;

        return $this;
    }
}
