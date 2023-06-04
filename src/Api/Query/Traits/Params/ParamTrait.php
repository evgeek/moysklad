<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Params;

use Evgeek\Moysklad\Services\QueryParams;

trait ParamTrait
{
    /**
     * Универсальный метод для формирования произвольного параметра url.
     * Несколько параметров можно применить, вызвав метод несколько раз, или при помощи массива массивов.
     *
     * <code>
     * $products = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->param('limit', 10)
     *  ->param([
     *      ['offset', '20'],
     *      ['search', 'orange'],
     *  ])
     *  ->get();
     * </code>
     */
    public function param(array|string $key, string|int|float|bool $value = null): static
    {
        $this->params = QueryParams::setParam($this->params, $key, $value);

        return $this;
    }
}
