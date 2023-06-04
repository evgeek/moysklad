<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Traits;

use Evgeek\Moysklad\Exceptions\RequestException;

trait IterateCollectionTrait
{
    /**
     * Перебирает загруженные в коллекцию сущности, отправляя их по одному в переданное замыкание.
     *
     * <code>
     * Product::collection($ms)
     *  ->get()
     *  ->each(function (Product $product) {
     *      echo $product->name . PHP_EOL;
     *  });
     * </code>
     */
    public function each(callable $closure): void
    {
        foreach ($this->rows ?? [] as $row) {
            $closure($row);
        }
    }

    /**
     * Перебирает все сущности в API Моего Склада, отправляя их по одному в переданное замыкание.
     * Самостоятельно отправляет дополнительные запросы, если ответ не вмещается в заданный limit (по умолчанию 1000).
     * Начинает перебор с заданного offset (по умолчанию 0).
     *
     * <code>
     * Product::collection($ms)
     *  ->limit(100)
     *  ->get()
     *  ->eachGenerator(function (Product $product) {
     *      echo $product->name . PHP_EOL;
     *  });
     * </code>
     *
     * @throws RequestException
     */
    public function eachGenerator(callable $closure): void
    {
        $this->get();

        do {
            $this->each($closure);
        } while ($this->getNext());
    }

    /**
     * Перебирает все сущности в API Моего Склада, отправляя их постранично коллекциями в переданное замыкание.
     * Хорошо сочетается с методами массового изменения (massCreateUpdate, massDelete).
     * Самостоятельно отправляет дополнительные запросы, если ответ не вмещается в заданный limit (по умолчанию 1000).
     * Начинает перебор с заданного offset (по умолчанию 0).
     *
     * <code>
     * Product::collection($ms)
     *  ->eachCollectionGenerator(function (ProductCollection $products) use ($ms) {
     *      $products->each(function (Product $product) {
     *          $product->name = mb_strtoupper($product->name);
     *      });
     *      Product::collection($ms)->massCreateUpdate($products);
     * });
     * </code>
     *
     * @throws RequestException
     */
    public function eachCollectionGenerator(callable $closure): void
    {
        $this->get();

        do {
            $closure(clone $this);
        } while ($this->getNext());
    }
}
