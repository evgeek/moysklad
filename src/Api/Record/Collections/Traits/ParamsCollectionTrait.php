<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Traits;

use Evgeek\Moysklad\Enums\FilterSign;
use Evgeek\Moysklad\Enums\OrderDirection;
use Evgeek\Moysklad\Services\QueryParams;
use Evgeek\Moysklad\Services\Url;

trait ParamsCollectionTrait
{
    /**
     * Разворачивает вложенную сущность. Работает только с limit <= 100 (ограничение API).
     * Несколько сущностей можно передать ввиде массива, или вызвать метод несколько раз.
     * Можно развернуть сущности с уровнем вложенности до 3, задав путь до неё через точку.
     *
     * <code>
     * $products = Product::collection($ms)
     *  ->limit(100)
     *  ->expand('owner')
     *  ->expand('minPrice.currency')
     *  ->expand(['group', 'images']);
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
     * Фильтрация результатов.
     * Принимает три параметра (имя свойства, знак, значение) или два (имя свойства и значение, знак по умолчанию - '=').
     * Несколько фильтров можно применить, вызвав метод несколько раз, или при помощи массива массивов.
     *
     * <code>
     * $products = Product::collection($ms)
     *  ->filter('archived', false)
     *  ->filter('name', '=~', 'apple')
     *  ->filter([
     *      ['minimumBalance', '=', '0'],
     *      ['code', FilterSign::NEQ, 123],
     *  ]);
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-fil-traciq-wyborki-s-pomosch-u-parametra-filter
     */
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

    /**
     * Ограничение максимального количества возвращаемых элементов (по умолчанию 1000).
     *
     * <code>
     * $products = Product::collection($ms)
     *  ->limit(100)
     *  ->get();
     * </code>
     */
    public function limit(int $amount): static
    {
        [$path, $params] = Url::parsePathAndParams($this->meta->href);
        $params = QueryParams::setLimit($params, $amount);
        $this->meta->href = Url::makeFromPathAndParams($path, $params);

        return $this;
    }

    /**
     * Смещение начала выборки, используется для пагинации.
     *
     * <code>
     * $products = Product::collection($ms)
     *  ->offset(100)
     *  ->get();
     * </code>
     */
    public function offset(int $amount): static
    {
        [$path, $params] = Url::parsePathAndParams($this->meta->href);
        $params = QueryParams::setOffset($params, $amount);
        $this->meta->href = Url::makeFromPathAndParams($path, $params);

        return $this;
    }

    /**
     * Сортировка результата по переданному полю.
     * Несколько сортировок можно применить, вызвав метод несколько раз, или при помощи массива массивов.
     *
     * <code>
     * $products = Product::collection($ms)
     *  ->order('updated', 'asc')
     *  ->order([
     *      ['code', 'desc'],
     *      ['name'],
     *  ]);
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-sortirowka-ob-ektow
     */
    public function order(array|string $field, OrderDirection|string $direction = 'asc'): static
    {
        [$path, $params] = Url::parsePathAndParams($this->meta->href);
        $params = QueryParams::setOrder($params, $field, $direction);
        $this->meta->href = Url::makeFromPathAndParams($path, $params);

        return $this;
    }

    /**
     * Контекстный поиск.
     *
     * <code>
     * $products = Product::collection($ms)
     *  ->search('orange')
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-kontextnyj-poisk
     */
    public function search(string $text): static
    {
        [$path, $params] = Url::parsePathAndParams($this->meta->href);
        $params = QueryParams::setSearch($params, $text);
        $this->meta->href = Url::makeFromPathAndParams($path, $params);

        return $this;
    }

    /**
     * Универсальный метод для формирования произвольного параметра url.
     * Несколько параметров можно применить, вызвав метод несколько раз, или при помощи массива массивов.
     *
     * <code>
     * $products = Product::collection($ms)
     *  ->param('limit', 10)
     *  ->param([
     *      ['offset', '20'],
     *      ['search', 'orange'],
     *  ])
     *  ->get();
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
