<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Params;

use Evgeek\Moysklad\Enums\OrderDirection;
use Evgeek\Moysklad\Services\QueryParams;

trait OrderTrait
{
    /**
     * Сортировка результата по переданному полю.
     * Несколько сортировок можно применить, вызвав метод несколько раз, или при помощи массива массивов.
     *
     * <code>
     * $products = $ms->query()
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
    public function order(array|string $field, OrderDirection|string $direction = 'asc'): static
    {
        $this->params = QueryParams::setOrder($this->params, $field, $direction);

        return $this;
    }
}
