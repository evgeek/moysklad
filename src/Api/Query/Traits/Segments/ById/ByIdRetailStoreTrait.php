<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Traits\Segments\ById;

use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdRetailStoreSegment;

trait ByIdRetailStoreTrait
{
    /**
     * Работа с точкой продаж по id.
     *
     * <code>
     * $retailStore = $ms->query()
     *  ->entity()
     *  ->retailstore()
     *  ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tochka-prodazh
     */
    public function byId(string $guid): ByIdRetailStoreSegment
    {
        return $this->resolveCommonBuilder(ByIdRetailStoreSegment::class, $guid);
    }
}
