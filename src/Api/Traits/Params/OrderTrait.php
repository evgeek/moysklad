<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Params;

use Evgeek\Moysklad\Enums\OrderDirection;
use Evgeek\Moysklad\Enums\QueryParam;
use InvalidArgumentException;

trait OrderTrait
{
    /**
     * Sorts result by field.
     * <code>
     * $product = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->order('updated', 'asc')
     *  ->order([
     *      ['code', 'desc'],
     *      ['name'],
     *  ])
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-sortirowka-ob-ektow
     */
    public function order(array|string $fields, OrderDirection|string $direction = 'asc'): static
    {
        if (is_array($fields)) {
            return $this->handleArrayOfOrders($fields);
        }

        $directionString = is_a($direction, OrderDirection::class) ? $direction->value : $direction;
        $sort = $fields . ',' . $directionString;

        $this->setQueryParam(QueryParam::ORDER, $sort);

        return $this;
    }

    private function handleArrayOfOrders(array $orders): static
    {
        foreach ($orders as $order) {
            if (!is_array($order)) {
                throw new InvalidArgumentException('Each order must be an array');
            }
            $this->order(...$order);
        }

        return $this;
    }
}
