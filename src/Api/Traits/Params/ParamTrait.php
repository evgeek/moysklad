<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Params;

use Evgeek\Moysklad\Enums\QueryParam;
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

        $separator = QueryParam::getSeparator($key);

        if ($separator === '') {
            $this->params[$key] = $value;

            return $this;
        }

        $this->initQueryParam($key);

        $this->params[$key] .= $this->params[$key] === '' ?
            $value :
            $separator . $value;

        return $this;
    }
}
