<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects\Traits;

use Evgeek\Moysklad\Services\QueryParams;
use Evgeek\Moysklad\Services\Url;

trait ParamsObjectTrait
{
    public function expand(array|string $field): static
    {
        [$path, $params] = Url::parsePathAndParams($this->meta->href);
        $params = QueryParams::setExpand($params, $field);
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
