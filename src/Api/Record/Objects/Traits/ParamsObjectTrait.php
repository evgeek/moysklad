<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Traits;

use Evgeek\Moysklad\Services\QueryParams;
use Evgeek\Moysklad\Services\Url;

trait ParamsObjectTrait
{
    /**
     * Разворачивает вложенную сущность.
     * Несколько сущностей можно передать ввиде массива, или вызвать метод несколько раз.
     * Можно развернуть сущности с уровнем вложенности до 3, задав путь до неё через точку.
     *
     * <code>
     * $product = Product::make($ms, ['id' => '66046520-f26f-11ed-0a80-0f6000692310'])
     *  ->expand('owner')
     *  ->expand('minPrice.currency')
     *  ->expand(['group', 'images'])
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-zamena-ssylok-ob-ektami-s-pomosch-u-expand
     */
    public function expand(array|string $field): static
    {
        [$path, $params] = Url::parsePathAndParams($this->meta->href);
        $params = QueryParams::setExpand($params, $field);
        $this->meta->href = Url::makeFromPathAndParams($path, $params);

        return $this;
    }

    /**
     * Универсальный метод для формирования произвольного параметра url.
     * Несколько параметров можно применить, вызвав метод несколько раз, или при помощи массива массивов.
     *
     * <code>
     * $product = Product::make($ms, ['id' => 'f98dc6a3-f323-11ed-0a80-0f600088f4ad'])
     *  ->param('expand', 'owner')
     *  ->param([
     *      ['expand', 'group'],
     *      ['expand', 'images,images.owner'],
     *  ])
     * ->get();
     * </code>
     */
    public function param(array|string $key, string|int|float|bool $value = null): static
    {
        [$path, $params] = Url::parsePathAndParams($this->meta->href);
        $params = QueryParams::setParam($params, $key, $value);
        $this->meta->href = Url::makeFromPathAndParams($path, $params);

        return $this;
    }
}
