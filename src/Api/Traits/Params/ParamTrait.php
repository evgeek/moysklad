<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Params;

use InvalidArgumentException;

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
        if (is_array($key)) {
            return $this->handleArrayOfParams($key);
        }

        if ($value === null) {
            throw new InvalidArgumentException("Value can't be null for the key '$key'");
        }

        $this->setQueryParam($key, $value);

        return $this;
    }

    private function handleArrayOfParams(array $params): static
    {
        foreach ($params as $param) {
            if (!is_array($param)) {
                throw new InvalidArgumentException('Each param must be an array');
            }
            $this->param(...$param);
        }

        return $this;
    }
}
