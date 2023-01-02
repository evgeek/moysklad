<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Methods\Endpoints;

use Evgeek\Moysklad\Api\Methods\Documents\Customerorder;
use Evgeek\Moysklad\Api\Methods\Entities\Assortment;
use Evgeek\Moysklad\Api\Methods\Entities\Product;

class Entity extends AbstractNamedEndpoint
{
    protected const PATH = 'entity';

    /**
     * Products -
     * https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-towar
     * <code>
     * $products = $ms->entity()
     *      ->product()
     *      ->get();
     * </code>
     */
    public function product(): Product
    {
        $this->addPayloadToList();
        return new Product($this->api, $this->payloadList);
    }

    /**
     * Customer orders
     * https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-pokupatelq
     * <code>
     * $customerOrders = $ms->entity()
     *      ->customerorder()
     *      ->get();
     * </code>
     */
    public function customerorder(): Customerorder
    {
        $this->addPayloadToList();
        return new Customerorder($this->api, $this->payloadList);
    }

    /**
     * Assortments
     * https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-assortiment
     * <code>
     * $assortments = $ms->entity()
     *      ->assortment()
     *      ->get();
     * </code>
     */
    public function assortment(): Assortment
    {
        $this->addPayloadToList();
        return new Assortment($this->api, $this->payloadList);
    }
}
