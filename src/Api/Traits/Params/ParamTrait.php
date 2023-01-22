<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Params;

use Evgeek\Moysklad\Enums\QueryParams;
use Evgeek\Moysklad\Services\UrlParam;
use Throwable;

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
        $value = UrlParam::convertMixedValueToString($value);

        try {
            $queryParam = QueryParams::from($key);
            $separator = $queryParam->separator();
        } catch (Throwable) {
            $separator = '';
        }

        if ($separator === '') {
            $this->params[$key] = $value;

            return $this;
        }

        if (!array_key_exists($key, $this->params)) {
            $this->params[$key] = '';
        }
        $this->params[$key] .= $this->params[$key] === '' ?
            $value :
            $separator . $value;

        return $this;
    }
}
