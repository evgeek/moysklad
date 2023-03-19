<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Params;

use Evgeek\Moysklad\Services\QueryParams;

trait ParamTrait
{
    /**
     * Generic query param
     * <code>
     * $order = $ms->query()
     *  ->entity()
     *  ->customerorder()
     *  ->param('limit', 10)
     *  ->param([
     *      ['offset', '20'],
     *      ['order', 'name;created_at,desc'],
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
