<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Params;

use Evgeek\Moysklad\Services\QueryParams;

trait LimitOffsetTrait
{
    /**
     * Ограничение максимального количества возвращаемых элементов (по умолчанию 1000).
     *
     * <code>
     * $products = $ms->query()
     *  ->entity()
     *  ->products()
     *  ->limit(100)
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/workbook/#workbook-fil-traciq-listanie-poisk-i-sortirowka-listanie
     */
    public function limit(int $amount): static
    {
        $this->params = QueryParams::setLimit($this->params, $amount);

        return $this;
    }

    /**
     * Смещение начала выборки, используется для пагинации.
     *
     * <code>
     * $products = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->offset(100)
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/workbook/#workbook-fil-traciq-listanie-poisk-i-sortirowka-listanie
     */
    public function offset(int $amount): static
    {
        $this->params = QueryParams::setOffset($this->params, $amount);

        return $this;
    }
}
