<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Params;

use Evgeek\Moysklad\Enums\OrderDirection;
use Evgeek\Moysklad\Enums\QueryParams;
use Evgeek\Moysklad\Enums\Sort;
use Evgeek\Moysklad\Exceptions\InputException;
use Throwable;

trait OrderTrait
{
    /**
     * Sorts result by field
     * <code>
     * $product = $ms->entity()
     *      ->product()
     *      ->order('updated', 'desc')
     *      ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-sortirowka-ob-ektow
     *
     * @throws InputException
     */
    public function order(string $field, OrderDirection|string $direction = 'asc'): static
    {
        if (is_string($direction)) {
            try {
                $directionEnum = OrderDirection::from($direction);
            } catch (Throwable) {
                throw new InputException("Unknown order direction '$direction'. Check " . OrderDirection::class);
            }
            $direction = $directionEnum;
        }
        $direction = $direction->value;

        if (!array_key_exists(Sort::NAME->value, $this->params)) {
            $this->params[Sort::NAME->value] = '';
        }

        $sort = $field . Sort::ORDER_SEPARATOR->value . $direction;
        $this->params[Sort::NAME->value] .= $this->params[Sort::NAME->value] === '' ?
            $sort :
            QueryParams::ORDER->separator() . $sort;

        return $this;
    }
}
