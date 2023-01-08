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
     * $products = $ms->entity()
     *      ->product()
     *      ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-towar
     */
    public function product(): Product
    {
        $this->addPayloadToList();

        return new Product($this->api, $this->payloadList);
    }

    /**
     * Customer orders
     * <code>
     * $customerOrders = $ms->entity()
     *      ->customerorder()
     *      ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-pokupatelq
     */
    public function customerorder(): Customerorder
    {
        $this->addPayloadToList();

        return new Customerorder($this->api, $this->payloadList);
    }

    /**
     * Assortments
     * <code>
     * $assortments = $ms->entity()
     *      ->assortment()
     *      ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-assortiment
     */
    public function assortment(): Assortment
    {
        $this->addPayloadToList();

        return new Assortment($this->api, $this->payloadList);
    }
}
