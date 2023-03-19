<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Params;

use Evgeek\Moysklad\Services\QueryParams;

trait LimitOffsetTrait
{
    /**
     * Maximum entities in response
     * <code>
     * $product = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->limit(100)
     *  ->offset(0)
     *  ->debug()
     *  ->get();
     * </code>
     */
    public function limit(int $limit): static
    {
        $this->params = QueryParams::setLimit($this->params, $limit);

        return $this;
    }

    /**
     * Offset for pagination
     * <code>
     * $product = $ms->entity()
     *  ->product()
     *  ->limit(100)
     *  ->offset(0)
     *  ->debug()
     *  ->get();
     * </code>
     */
    public function offset(int $offset): static
    {
        $this->params = QueryParams::setOffset($this->params, $offset);

        return $this;
    }
}
