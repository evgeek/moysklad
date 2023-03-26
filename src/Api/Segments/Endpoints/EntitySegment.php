<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Segments\Endpoints;

use Evgeek\Moysklad\Api\Segments\Methods\Documents\CustomerorderSegment;
use Evgeek\Moysklad\Api\Segments\Methods\Entities\AssortmentSegment;
use Evgeek\Moysklad\Api\Segments\Methods\Entities\ProductSegment;
use Evgeek\Moysklad\Dictionaries\Endpoint;

class EntitySegment extends AbstractEndpointSegmentNamed
{
    protected const SEGMENT = Endpoint::ENTITY;

    /**
     * Products
     * <code>
     * $products = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-towar
     */
    public function product(): ProductSegment
    {
        return $this->resolveNamedBuilder(ProductSegment::class);
    }

    /**
     * Customer orders
     * <code>
     * $customerOrders = $ms->query()
     *  ->entity()
     *  ->customerorder()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-pokupatelq
     */
    public function customerorder(): CustomerorderSegment
    {
        return $this->resolveNamedBuilder(CustomerorderSegment::class);
    }

    /**
     * Assortments
     * <code>
     * $assortments = $ms->query()
     *  ->entity()
     *  ->assortment()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-assortiment
     */
    public function assortment(): AssortmentSegment
    {
        return $this->resolveNamedBuilder(AssortmentSegment::class);
    }
}
