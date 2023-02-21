<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Params;

trait ParamTrait
{
    /**
     * Generic query param
     * <code>
     * $order = $ms->query()
     *  ->entity()
     *  ->customerorder()
     *  ->param('limit', 10)
     *  ->get();
     * </code>
     */
    public function param(string $key, string|int|float|bool $value): static
    {
        $this->setQueryParam($key, $value);

        return $this;
    }
}
