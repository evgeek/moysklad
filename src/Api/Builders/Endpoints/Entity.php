<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders\Endpoints;

use Evgeek\Moysklad\Api\Builders\Methods\Documents\Customerorder;
use Evgeek\Moysklad\Api\Builders\Methods\Entities\Assortment;
use Evgeek\Moysklad\Api\Builders\Methods\Entities\Product;

class Entity extends EndpointNamed
{
    protected const PATH = 'entity';

    /**
     * Products
     * <code>
     * $products = $ms->query()
     *      ->entity()
     *      ->product()
     *      ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-towar
     */
    public function product(): Product
    {
        return $this->resolveNamedBuilder(Product::class);
    }

    /**
     * Customer orders
     * <code>
     * $customerOrders = $ms->query()
     *      ->entity()
     *      ->customerorder()
     *      ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-pokupatelq
     */
    public function customerorder(): Customerorder
    {
        return $this->resolveNamedBuilder(Customerorder::class);
    }

    /**
     * Assortments
     * <code>
     * $assortments = $ms->query()
     *      ->entity()
     *      ->assortment()
     *      ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-assortiment
     */
    public function assortment(): Assortment
    {
        return $this->resolveNamedBuilder(Assortment::class);
    }
}
