<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Params;

use Evgeek\Moysklad\Services\QueryParams;

trait ExpandTrait
{
    /**
     * Разворачивает вложенную сущность. Работает только с limit <= 100 (ограничение API).
     * Несколько сущностей можно передать ввиде массива, или вызвать метод несколько раз.
     * Можно развернуть сущности с уровнем вложенности до 3, задав путь до неё через точку.
     *
     * <code>
     * $products = $ms->query()
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
