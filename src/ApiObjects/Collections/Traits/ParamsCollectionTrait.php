<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Collections\Traits;

use Evgeek\Moysklad\Enums\FilterSign;
use Evgeek\Moysklad\Enums\OrderDirection;
use Evgeek\Moysklad\Services\QueryParams;
use Evgeek\Moysklad\Services\Url;

trait ParamsCollectionTrait
{
    public function expand(array|string $field): static
    {
        [$path, $params] = Url::parsePathAndParams($this->meta->href);
        $params = QueryParams::setExpand($params, $field);
        $this->meta->href = Url::makeFromPathAndParams($path, $params);

        return $this;
    }

    public function filter(
        array|string $key,
        FilterSign|string|int|float|bool $sign = null,
        string|int|float|bool $value = null
    ): static {
        [$path, $params] = Url::parsePathAndParams($this->meta->href);
        $params = QueryParams::setFilter($params, $key, $sign, $value);
        $this->meta->href = Url::makeFromPathAndParams($path, $params);

        return $this;
    }

    public function limit(int $limit): static
    {
        [$path, $params] = Url::parsePathAndParams($this->meta->href);
        $params = QueryParams::setLimit($params, $limit);
        $this->meta->href = Url::makeFromPathAndParams($path, $params);

        return $this;
    }

    public function offset(int $offset): static
    {
        [$path, $params] = Url::parsePathAndParams($this->meta->href);
        $params = QueryParams::setOffset($params, $offset);
        $this->meta->href = Url::makeFromPathAndParams($path, $params);

        return $this;
    }

    public function order(array|string $field, OrderDirection|string $direction = 'asc'): static
    {
        [$path, $params] = Url::parsePathAndParams($this->meta->href);
        $params = QueryParams::setOrder($params, $field, $direction);
        $this->meta->href = Url::makeFromPathAndParams($path, $params);

        return $this;
    }

    public function search(string $text): static
    {
        [$path, $params] = Url::parsePathAndParams($this->meta->href);
        $params = QueryParams::setSearch($params, $text);
        $this->meta->href = Url::makeFromPathAndParams($path, $params);

        return $this;
    }

    public function param(array|string $key, string|int|float|bool $value = null): static
    {
        [$path, $params] = Url::parsePathAndParams($this->meta->href);
        $params = QueryParams::setParam($params, $key, $value);
        $this->meta->href = Url::makeFromPathAndParams($path, $params);

        return $this;
    }
}
